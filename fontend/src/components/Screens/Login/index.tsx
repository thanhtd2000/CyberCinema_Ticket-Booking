import React from 'react';
import style from './style.module.less';
import { Row, Col, Typography, Button, Checkbox, Form, Input } from 'antd';
import Link from 'next/link';
import Image from 'next/image';
import { useRouter } from 'next/router';
import { useMutationSignIn } from '@/queries/hooks';
import { TSignIn } from '@/modules';
const { Title } = Typography;
function LoginScreen() {
      const { mutate: signIn } = useMutationSignIn();
      const router = useRouter();
      const onFinish = (values: TSignIn) => {
        signIn(values, {
          onSuccess: () => {
            router.push({ pathname: '/' });
          },
        });
      };

      return (
            <div className='LoginStyle'>
                  <Row className={style.Login}>
                        <Col span={24} className={style.logo}>
                              <Image src='/images/Group 7.png' height={48} width={186.43} alt='logo' />
                        </Col>
                        <Col  className={style.formLogin}>
                              <Row>
                                    <Col span={24}>
                                          <Title level={2}>Đăng nhập</Title>
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
                                                      name='email'
                                                      rules={[{ required: true, message: 'Vui lòng nhập email hoặc số điện thoại hợp lệ.' }]}
                                                >
                                                      <Input className={style.input} placeholder='Email hoặc số điện thoại' />
                                                </Form.Item>

                                                <Form.Item
                                                      name='password'
                                                      rules={[{ required: true, message: 'Mật khẩu của bạn phải chứa từ 4 đến 60 ký tự.' }]}
                                                >
                                                      <Input className={style.input} placeholder='Password' />
                                                </Form.Item>

                                                <Form.Item name='remember' valuePropName='checked'>
                                                      <Checkbox style={{ color: '#b3b3b3', fontSize: '12px' }}>Ghi nhớ tôi</Checkbox>
                                                      <span style={{ color: '#b3b3b3', fontSize: '12px' }}>Chưa có tài khoản <Link href='register' style={{ color: 'orange', textDecoration: 'underline' }}>Đăng kí ngay</Link></span>
                                                </Form.Item>

                                                <Form.Item>
                                                      <Button type='primary' className={style.buttonLogin} htmlType='submit'>
                                                            Đăng nhập
                                                      </Button>
                                                </Form.Item>
                                          </Form>
                                    </Col>
                              </Row>
                        </Col>
                  </Row>
            </div>
      );
}

export default LoginScreen;
