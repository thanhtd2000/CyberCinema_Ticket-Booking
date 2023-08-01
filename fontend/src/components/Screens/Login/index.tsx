import React, { useState } from 'react';
import style from './style.module.less';
import { Row, Col, Typography, Button, Form, Input } from 'antd';
import Link from 'next/link';
import Image from 'next/image';
import { useRouter } from 'next/router';
import { useMutationSignIn } from '@/queries/hooks';
import { TSignIn } from '@/modules';
const { Title } = Typography;
function LoginScreen() {
  const { mutate: signIn } = useMutationSignIn();
  const [error, setError] = useState(false);
  const router = useRouter();
  const onFinish = (values: TSignIn) => {
    signIn(values, {
      onSuccess: () => {
        router.push({ pathname: '/' });
      },
      onError: () => {
        setError(true);
      },
    });
  };

  return (
    <div className='LoginStyle'>
      <div style={{position: 'relative'}}>
        <div className={style.blur} />
        <Row className={style.Login}>
          <Col span={24} className={style.logo}>
            <Image src='/images/logoCyberMovies.png' height={100} width={100} alt='logo' />
          </Col>
          <Col className={style.formLogin}>
            <Row className={style.formConfirm}>
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
                    name='username'
                    rules={[{ required: true, message: 'Vui lòng nhập email hoặc số điện thoại hợp lệ.' }]}
                  >
                    <Input className={style.input} placeholder='Email hoặc số điện thoại' />
                  </Form.Item>

                  <Form.Item
                    name='password'
                    rules={[{ required: true, message: 'Mật khẩu của bạn phải chứa từ 4 đến 60 ký tự.' }]}
                  >
                    <Input className={style.input} type='password' placeholder='Password' />
                  </Form.Item>
                  <span>{error ? <div style={{ color: 'red' }}>Mật khẩu hoặc email không chính xác</div> : null}</span>
                  <Form.Item name='remember' valuePropName='checked'>
                    <span style={{ color: '#b3b3b3', fontSize: '12px' }}>
                      Chưa có tài khoản{' '}
                      <Link href='register' style={{ color: 'orange', textDecoration: 'underline' }}>
                        Đăng kí ngay
                      </Link>
                    </span>
                  </Form.Item>

                  <Form.Item>
                    <Button type='primary' className={style.buttonLogin} htmlType='submit'>
                      Đăng nhập
                    </Button>
                    <Button type='primary' href='/forgot-password' className={style.forgotPass}>
                      Quên mật khẩu
                    </Button>
                  </Form.Item>
                </Form>
              </Col>
            </Row>
          </Col>
        </Row>
      </div>
    </div>
  );
}

export default LoginScreen;
