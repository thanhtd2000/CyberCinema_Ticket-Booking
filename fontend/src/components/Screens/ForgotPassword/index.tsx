import { Button, Col, Form, Input, Row, Typography } from 'antd';
import React, { useState } from 'react';
import style from './style.module.less';
import Image from 'next/image';
import { useRouter } from 'next/router';
import Link from 'next/link';
import { useQueryGetNewEmail } from '@/queries/hooks/user';
const { Title } = Typography;

function ForgotPasswordScreen() {
  const [error, setError] = useState(false);
  const router = useRouter();
  const { mutate: getNewPass } = useQueryGetNewEmail();
  const onFinish = (values: any) => {
    getNewPass(
      { data: { ...values } },
      {
        onSuccess: () => {
          router.push({ pathname: '/confirm-password' });
        },
        onError: () => {
          setError(true);
        },
      },
    );
  };
  return (
    <div className='LoginStyle'>
      <div style={{ position: 'relative' }}>
        <div className={style.blur} />
        <Row className={style.Login}>
          <Col span={24} className={style.logo}>
            <Image src='/images/logoCyberMovies.png' height={100} width={100} alt='logo' />
          </Col>
          <Col className={style.formLogin}>
            <Row>
              <Col span={24}>
                <Title level={2}>Quên mật khẩu</Title>
              </Col>
              <Col span={24}>
                <Form
                  name='basic'
                  wrapperCol={{ span: 24 }}
                  initialValues={{ remember: true }}
                  onFinish={onFinish}
                  autoComplete='off'
                >
                  <Form.Item name='email' rules={[{ required: true, message: 'Vui lòng nhập email hợp lệ.' }]}>
                    <Input className={style.input} placeholder='Email' />
                  </Form.Item>
                  <span>{error ? <div style={{ color: 'red' }}>Email không chính xác</div> : null}</span>
                  <Form.Item>
                    <span style={{ color: '#b3b3b3', fontSize: '12px' }}>
                      Đã có tài khoản{' '}
                      <Link href='login' style={{ color: 'orange', textDecoration: 'underline' }}>
                        Đăng nhập ngay
                      </Link>
                    </span>
                  </Form.Item>

                  <Form.Item>
                    <Button type='primary' className={style.buttonLogin} htmlType='submit'>
                      Tiếp theo
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

export default ForgotPasswordScreen;
