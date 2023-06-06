import React, { useMemo } from 'react'
import style from './style.module.less'
import { BsImageAlt } from 'react-icons/bs';
import { Breadcrumb, Button, Checkbox, Col, DatePicker, Form, Input, Radio, Row, Select, Upload } from 'antd'
import { USER_PROFILE } from '@/queries/keys';
import { getLocalStored } from '@/libs/localStorage';
import dayjs from 'dayjs';
import { UploadOutlined } from '@ant-design/icons';
function UserScreen() {
      const onFinish = (values: any) => {
            console.log('Success:', values);
      };

      const onFinishFailed = (errorInfo: any) => {
            console.log('Failed:', errorInfo);
      };
      const normFile = (e: any) => {
            if (Array.isArray(e)) {
                  return e;
            }
            return e?.fileList;
      };
      const user = getLocalStored(USER_PROFILE)
      const dateFormat = 'YYYY/MM/DD';
      console.log(user);
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
                        <div>
                              <Form
                                    name="basic"
                                    labelCol={{ span: 8 }}
                                    wrapperCol={{ span: 16 }}
                                    style={{ maxWidth: 600 }}
                                    initialValues={{ remember: true }}
                                    onFinish={onFinish}
                                    onFinishFailed={onFinishFailed}
                                    autoComplete="off"
                              >

                                    <Form.Item label="Upload" valuePropName="fileList" getValueFromEvent={normFile} name='image'>
                                          <Upload action="/upload.do" listType="picture-card">
                                                <div>
                                                      <BsImageAlt style={{ fill: 'white' }} />
                                                      <div style={{ marginTop: 8, color: 'white' }}>Upload</div>
                                                </div>
                                          </Upload>
                                    </Form.Item>
n 
                                    <Form.Item
                                          label="Username"
                                          name="username"

                                    >
                                          <Input defaultValue={user?.name} />
                                    </Form.Item>

                                    <Form.Item
                                          label="Email"
                                          name="email"
                                    >
                                          <Input disabled style={{ backgroundColor: 'white' }} defaultValue={user?.email} />
                                    </Form.Item>

                                    <Form.Item
                                          label="Phone"
                                          name="phone"
                                    >
                                          <Input defaultValue={user?.phone} />
                                    </Form.Item>


                                    <Form.Item label="DatePicker" name="birth">
                                          <DatePicker defaultValue={dayjs(user?.birthday, dateFormat)} format={dateFormat} />
                                    </Form.Item>
                                    <Form.Item label="Sex" name='sex'>
                                          <Input defaultValue={user?.sex} disabled style={{ backgroundColor: 'white' }} />
                                    </Form.Item>

                                    <Form.Item wrapperCol={{ offset: 8, span: 16 }}>
                                          <Button type="primary" htmlType="submit">
                                                Update
                                          </Button>
                                    </Form.Item>
                              </Form>
                        </div>
                  </div>
            </div>
      )
}

export default UserScreen