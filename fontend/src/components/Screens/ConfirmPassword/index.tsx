import { Button, Col, Form, Input, Row, Typography } from 'antd';
import React, { useState } from 'react';
import style from './style.module.less';
import Image from 'next/image';
import { useRouter } from 'next/router';
import { useQueryCheckCode } from '@/queries/hooks/user';
const { Title } = Typography;

function ConfirmPassword() {
  const [error, setError] = useState(false);
  const router = useRouter();
  const { mutate: mutationCheckPass } = useQueryCheckCode();
  const onFinish = (values: any) => {
    mutationCheckPass(
      { data: { ...values } },
      {
        onSuccess: () => {
          router.push({ pathname: '/login' });
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
            <Row className={style.formConfirm}>
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
                  <Form.Item name='email' rules={[{ required: true, message: 'Vui lòng nhập email hợp lệ.' }]}>
                    <Input className={style.input} placeholder='Email' />
                  </Form.Item>
                  <span>{error ? <div style={{ color: 'red' }}>Email không chính xác</div> : null}</span>
                  <Form.Item name='code' rules={[{ required: true, message: 'Vui lòng nhập code hợp lệ.' }]}>
                    <Input className={style.input} placeholder='Mã đổi mật khẩu' />
                  </Form.Item>
                  <span>{error ? <div style={{ color: 'red' }}>Code không chính xác</div> : null}</span>
                  <Form.Item
                    name='password'
                    rules={[
                      {
                        required: true,
                        message: 'Vui lòng nhập mật khẩu hợp lệ.',
                      },
                    ]}
                    hasFeedback
                  >
                    <Input.Password className={style.input} placeholder='Mật khẩu' />
                  </Form.Item>

                  <Form.Item
                    name='confirm'
                    dependencies={['password']}
                    hasFeedback
                    rules={[
                      {
                        required: true,
                        message: 'Vui lòng nhập lại mật khẩu hợp lệ.',
                      },
                      ({ getFieldValue }) => ({
                        validator(_, value) {
                          if (!value || getFieldValue('password') === value) {
                            return Promise.resolve();
                          }
                          return Promise.reject(new Error('Mật khẩu mới mà bạn đã nhập không khớp!'));
                        },
                      }),
                    ]}
                  >
                    <Input.Password className={style.input} placeholder='Nhập lại mật khẩu' />
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
    </div>
  );
}

export default ConfirmPassword;
