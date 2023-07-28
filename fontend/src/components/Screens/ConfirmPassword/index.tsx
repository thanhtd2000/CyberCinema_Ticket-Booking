import { Button, Col, Form, Input, Row, Typography } from 'antd'
import React, { useState } from 'react'
import style from './style.module.less';
import Image from 'next/image';
import { useRouter } from 'next/router';
import { useQueryGetNewEmail } from '@/queries/hooks/user';
const { Title } = Typography;


function ConfirmPassword() {
      const [error,setError] = useState(false)
      const router = useRouter();
      const {mutate: getNewPass} = useQueryGetNewEmail()
      const onFinish = (values: any) => {
            console.log(values);
            getNewPass(values, {
                  onSuccess: () => {
                        router.push({ pathname: '/' });
                  },
                  onError: () =>{
                        setError(true)
                  }
            });
      };
  return (
      <div className='LoginStyle'>
      <Row className={style.Login}>
            <Col span={24} className={style.logo}>
                  <Image src='/images/logoCyberMovies.png' height={100} width={100} alt='logo' />
            </Col>
            <Col className={style.formLogin}>
                  <Row>
                        <Col span={24}>
                              <Title level={2}>Đổi mật khẩu</Title>
                        </Col>
                        <Col span={24}>
                              <Form
                                    name='basic'
                                    wrapperCol={{ span: 24 }}
                                    initialValues={{ remember: true }}
                                    onFinish={onFinish}
                                    autoComplete='off'
                              >
                                    <Form.Item
                                          name='code'
                                          rules={[{ required: true, message: 'Vui lòng nhập code hợp lệ.' }]}
                                    >
                                          <Input className={style.input} placeholder='Mã đổi mật khẩu' />
                                    </Form.Item>
                                    <span>
                                          {error? (<div style={{color: 'red'}}>Code không chính xác</div>) : null}
                                    </span>
                                    <Form.Item
                                          name='pass'
                                          rules={[{ required: true, message: 'Vui lòng nhập mật khẩu hợp lệ.' }]}
                                    >
                                          <Input className={style.input} placeholder='Mật khẩu' />
                                    </Form.Item>
                                    <Form.Item
                                          name='re-pass'
                                          rules={[{ required: true, message: 'Vui lòng nhập lại mật khẩu hợp lệ.' }]}
                                    >
                                          <Input className={style.input} placeholder='Nhập lại mật khẩu' />
                                    </Form.Item>
                                    <Form.Item>
                                          <Button type='primary' className={style.buttonLogin} htmlType='submit'>
                                                Đổi mật khẩu
                                          </Button>
                                    </Form.Item>
                              </Form>
                        </Col>
                  </Row>
            </Col>
      </Row>
</div>
  )
}

export default ConfirmPassword