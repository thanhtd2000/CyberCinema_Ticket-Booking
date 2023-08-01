import React, { useEffect, useState } from 'react'
import style from './style.module.less'
import { Breadcrumb, Button, Col, Form, Input, Row } from 'antd'
import { checkAuth } from '@/libs/localStorage';
import { queryGetProfile, useMutationUpdatePassword, useMutationUpdateUser } from '@/queries/hooks/user';
function UserScreen() {
      const { mutate: updateUser } = useMutationUpdateUser()
      const { mutate: updatePassword } = useMutationUpdatePassword()
      const [token, setToken] = useState("");
      useEffect(() => {
            if (checkAuth()) {
                  setToken(checkAuth())
            }
      }, [checkAuth()])
      const onFinish = (values: any) => {
            console.log('Success:', values);
            updateUser({ token, data: { ...values, image: values.image?.file } })
      };
      const onFinishForm = (value: any) =>{
            console.log(value);
            updatePassword({token, data: {...value} })
      }
      const { data: user } = queryGetProfile(token);
      return (
            <div className={`${style.infor} inforUser`} style={{ background: '#0D0E10' }}>
                  <div className='container'>
                        <div>
                              <Breadcrumb
                                    style={{ color: 'rgb(183, 177, 177)', paddingBottom: '30px', fontSize: '17px' }}
                                    items={[
                                          {
                                                title: 'Home',
                                          },
                                          {
                                                title: <a href="" style={{ color: 'white' }}>Thông tin cá nhân</a>,
                                          }
                                    ]}
                              />
                        </div>
                        <Row>
                              <Col xs={24} sm={24} md={24} lg={12} className={style.updateInfor}>
                                    {
                                          user && (<Form
                                                name="basic"
                                                wrapperCol={{ span: 24 }}
                                                labelCol={{ md: 6,lg: 5 }}
                                                initialValues={{ remember: true }}
                                                onFinish={onFinish}
                                                autoComplete="off"
                                          >
      
                                                <Form.Item
                                                      label="Username"
                                                      name="name"
                                                      initialValue={user?.name}
                                                >
                                                      <Input />
                                                </Form.Item>
      
                                                <Form.Item
                                                      label="Email"
                                                      name="email"
                                                      initialValue={user?.email}
                                                >
                                                      <Input disabled style={{ backgroundColor: 'white' }} />
                                                </Form.Item>
      
                                                <Form.Item
                                                      label="Phone"
                                                      name="phone"
                                                      initialValue={user?.phone}
      
                                                >
                                                      <Input />
                                                </Form.Item>
                                                <Form.Item label="Sex" name='sex' initialValue={user?.sex}>
                                                      <Input disabled style={{ backgroundColor: 'white' }} />
                                                </Form.Item>
                                                <Form.Item label="Số Points" name='points' initialValue={user?.points}>
                                                      <Input disabled style={{ backgroundColor: 'white' }} />
                                                </Form.Item>
                                                <Form.Item style={{textAlign: 'center'}}>
                                                      <Button type="primary" htmlType="submit">
                                                            Update
                                                      </Button>
                                                </Form.Item>
                                          </Form>)
                                    }
                              </Col>
                              <Col xs={24} sm={24} md={24} lg={12} className={style.updatePassword}>
                                    <Form
                                          name="basic"
                                          wrapperCol={{ span: 24 }}
                                          labelCol={{ lg: 8,xl: 6 }}
                                          initialValues={{ remember: true }}
                                          onFinish={onFinishForm}
                                          autoComplete="off"
                                    >

                                          <Form.Item
                                                label="Mật khẩu hiện tại"
                                                name="current_password"
                                          >
                                                <Input />
                                          </Form.Item>

                                          <Form.Item
                                                label="Mật khẩu mới"
                                                name="new_password"
                                          >
                                                <Input style={{ backgroundColor: 'white' }} />
                                          </Form.Item>
                                          <Form.Item style={{textAlign: 'center'}}>
                                                <Button type="primary" htmlType="submit">
                                                      Đổi mật khẩu
                                                </Button>
                                          </Form.Item>
                                    </Form>
                              </Col>
                        </Row>
                  </div>
            </div>
      )
}

export default UserScreen