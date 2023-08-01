import React from 'react';
import style from './style.module.less';
import { Radio } from 'antd';
import { Row, Col, Typography, Button, Checkbox, Form, Input, DatePicker } from 'antd';
import Link from 'next/link';
import Image from 'next/image';
import { TRegister } from '@/modules';
import { useRouter } from 'next/router';
import { useRegister } from '@/queries/hooks';
const { Title } = Typography;
function RegisterScreen() {
  const router = useRouter();
  const dateFormat = 'YYYY/MM/DD';
  const { mutate: register } = useRegister();
  const onFinish = (values: TRegister) => {
    register(values, {
      onSuccess: () => {
        // setStep(2);
        router.push('/');
      },
    });
  };
  const range = (start: number, end: number) => {
    const result = [];
    for (let i = start; i < end; i++) {
      result.push(i);
    }
    return result;
  };
  const disabledDateTime = () => ({
    disabledHours: () => range(0, 24).splice(4, 20),
    disabledMinutes: () => range(30, 60),
    disabledSeconds: () => [55, 56],
  });

  const onFinishFailed = (errorInfo: any) => {
    console.log('Failed:', errorInfo);
  };
  return (
    <div className='RegisterStyle'>
      <div style={{ position: 'relative' }}>
        <div className={style.blur} />
        <Row className={style.Register}>
          <Col span={24}>
            <Image className={style.logoWeb} src='/images/logoCyberMovies.png' height={100} width={100} alt='logo' />
            <Image className={style.logoMobie} src='/images/logoCyberMobie.png' height={60} width={80} alt='logo' />
          </Col>
          <Col className={style.formRegister}>
            <Row>
              <Col span={24}>
                <Title level={2}>Đăng ký</Title>
              </Col>
              <Col span={24}>
                <Form
                  name='basic'
                  wrapperCol={{ span: 24 }}
                  initialValues={{ remember: true }}
                  onFinish={onFinish}
                  onFinishFailed={onFinishFailed}
                  autoComplete='off'
                >
                  <Form.Item name='name' rules={[{ required: true, message: 'Vui lòng nhập tên hợp lệ.' }]}>
                    <Input className={style.input} placeholder='Tên' />
                  </Form.Item>

                  <Form.Item
                    name='email'
                    rules={[{ required: true, message: 'Email của bạn phải chứa từ 4 đến 60 ký tự.' }]}
                  >
                    <Input className={style.input} placeholder='Email' />
                  </Form.Item>

                  <Form.Item name='phone' rules={[{ required: true, message: 'Vui lòng nhập số điện thoại hợp lệ.' }]}>
                    <Input className={style.input} placeholder='Số điện thoại' />
                  </Form.Item>
                  <div style={{ display: 'flex' }}>
                    <Form.Item
                      style={{ width: '50%', marginRight: '10px' }}
                      name='birthday'
                      rules={[{ required: true, message: 'Vui lòng chọn ngày sinh' }]}
                    >
                      <DatePicker disabledTime={disabledDateTime} format={dateFormat} />
                    </Form.Item>
                    <Form.Item
                      style={{ width: '50%' }}
                      name='sex'
                      rules={[{ required: true, message: 'Vui lòng chọn giới tính.' }]}
                    >
                      <Radio.Group>
                        <Radio style={{ color: 'white' }} value='man'>
                          {' '}
                          Nam{' '}
                        </Radio>
                        <Radio style={{ color: 'white' }} value='woman'>
                          {' '}
                          Nữ{' '}
                        </Radio>
                      </Radio.Group>
                    </Form.Item>
                  </div>
                  <Form.Item
                    name='password'
                    rules={[{ required: true, message: 'Mật khẩu của bạn phải chứa từ 4 đến 60 ký tự.' }]}
                  >
                    <Input className={style.input} placeholder='Password' />
                  </Form.Item>

                  <Form.Item style={{ margin: '0px' }} name='remember' valuePropName='checked'>
                    <Checkbox style={{ color: '#b3b3b3', fontSize: '12px' }}>
                      Tôi đồng ý với <Link href='/'>Điều khoản của Cyber Movies</Link>
                    </Checkbox>
                  </Form.Item>
                  <Form.Item name='remember'>
                    <span style={{ color: '#b3b3b3', fontSize: '12px' }}>
                      Đã có tài khoản{' '}
                      <Link href='login' style={{ color: 'orange', textDecoration: 'underline' }}>
                        Đăng nhập ngay
                      </Link>
                    </span>
                  </Form.Item>
                  <Form.Item>
                    <Button type='primary' className={style.buttonLogin} htmlType='submit'>
                      Đăng ký
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

export default RegisterScreen;
