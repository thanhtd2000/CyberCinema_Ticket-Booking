/* eslint-disable @typescript-eslint/no-explicit-any */
/* eslint-disable react/no-unescaped-entities */
import { Button, Col, Form, Input, Row, Space, Typography } from 'antd';
import Image from 'next/image';
import PhoneInput from 'react-phone-input-2';
import 'react-phone-input-2/lib/style.css'

import { regexEmail, regexPhoneNumber } from '@/utils/regex';
import { formatNumberWithDot } from '@/components/Widgets/formatNumberPhone/formatNumberPhone';

import styles from './style.module.less';
import { useQueryContact } from '@/queries/hooks/user';

const { Title, Text } = Typography;
const { TextArea } = Input;

function ContactScreen() {
  const [form] = Form.useForm();
  const { mutate: useMutateContact } = useQueryContact();
  const onFinish = (values: any) => {
      useMutateContact( { data: { ...values } })
  };

  return (
    <div style={{ background: '#0D0E10' }}>
      <div className='container' style={{ background: '#0D0E10' }}>
        <div className={styles.wrapper}>
          <div className={styles.background}>
            <div className={styles.blur} />
            <Image className={styles.img} src='/images/BackgroundLogin.jpg' alt='background' fill />
            <Image className={styles.imgTablet} src='/images/backgroundTablet.jpg' alt='background' fill />
            <div className='home-container'>
              <div className='home-wrapper'>
                <Row gutter={[24, 0]} className={styles.bgWrap}>
                  <Col span={24} className={styles.breadcrumb}></Col>
                  <Col span={24}>
                    <Row>
                      <Col span={24} className={styles.title}>
                        <Title level={1}>
                          <Text>Chúng tôi có thể</Text>
                          <Text>Trợ giúp bạn nhanh chóng</Text>
                        </Title>
                      </Col>
                      <Col span={24}>
                        <Row gutter={[24, 18]} className={styles.statistical}>
                          <Col span={24} sm={{ span: 8 }} lg={{ span: 7 }} xl={{ span: 6 }}>
                            <div className={styles.line}>
                              <span className={styles.lineIcon}>
                                <svg
                                  xmlns='http://www.w3.org/2000/svg'
                                  width='16'
                                  height='16'
                                  viewBox='0 0 16 16'
                                  fill='none'
                                >
                                  <g clip-path='url(#clip0_1427_24402)'>
                                    <path
                                      d='M8.17936 0C6.4415 0.0440361 4.79198 0.775255 3.59232 2.0334C2.39266 3.29154 1.74073 4.97397 1.7794 6.71196C1.7794 10.2239 7.03537 15.2239 7.63537 15.7839C7.7825 15.9227 7.97711 16 8.17936 16C8.38162 16 8.57623 15.9227 8.72336 15.7839C9.32336 15.2239 14.5793 10.2239 14.5793 6.71196C14.618 4.97397 13.9661 3.29154 12.7664 2.0334C11.5667 0.775255 9.91723 0.0440361 8.17936 0ZM8.17936 3.99998C8.65404 3.99998 9.11805 4.14074 9.51272 4.40445C9.9074 4.66816 10.215 5.04299 10.3967 5.48153C10.5783 5.92007 10.6258 6.40263 10.5332 6.86818C10.4406 7.33373 10.2121 7.76137 9.87641 8.09701C9.54077 8.43266 9.11313 8.66123 8.64758 8.75384C8.18203 8.84644 7.69947 8.79891 7.26093 8.61726C6.82239 8.43561 6.44756 8.128 6.18385 7.73333C5.92013 7.33865 5.77938 6.87464 5.77938 6.39996C5.78128 5.76403 6.03474 5.15469 6.48441 4.70502C6.93409 4.25534 7.54343 4.00188 8.17936 3.99998Z'
                                      fill='#FA8C16'
                                    />
                                  </g>
                                  <defs>
                                    <clipPath id='clip0_1427_24402'>
                                      <rect width='16' height='16' fill='white' />
                                    </clipPath>
                                  </defs>
                                </svg>
                              </span>
                            </div>
                            <Title className={`${styles.title} ellipsis oneline`} level={3}>
                              Địa chỉ
                            </Title>
                            <Text className={`${styles.desc} ellipsis threeline`}>
                              T21A - Tòa nhà Sông Đà - Mỹ Đình 1 - Nam Từ Liêm - Hà Nội
                            </Text>
                          </Col>
                          <Col span={24} sm={{ span: 8 }} lg={{ span: 7 }} xl={{ span: 6 }}>
                            <div className={styles.line}>
                              <span className={styles.lineIcon}>
                                <svg
                                  xmlns='http://www.w3.org/2000/svg'
                                  width='16'
                                  height='16'
                                  viewBox='0 0 16 16'
                                  fill='none'
                                >
                                  <g clip-path='url(#clip0_1427_24386)'>
                                    <path
                                      d='M15.965 12.3971C15.9198 12.2607 15.6318 12.0598 15.1014 11.7949C14.9578 11.7114 14.753 11.5979 14.4881 11.454C14.223 11.31 13.9823 11.1774 13.7665 11.0561C13.5503 10.9349 13.3478 10.8175 13.1585 10.7041C13.1283 10.6813 13.0336 10.6151 12.8745 10.505C12.7152 10.3953 12.581 10.3138 12.4709 10.2607C12.3611 10.2079 12.2531 10.1813 12.147 10.1813C11.9955 10.1813 11.8063 10.2893 11.5791 10.505C11.3519 10.7211 11.1435 10.9558 10.9542 11.2098C10.7649 11.4637 10.5641 11.6983 10.3522 11.9142C10.14 12.1302 9.96562 12.2382 9.82942 12.2382C9.76104 12.2382 9.67579 12.2191 9.57362 12.1815C9.47149 12.1436 9.3938 12.1112 9.34047 12.085C9.28761 12.0583 9.1969 12.0055 9.06803 11.9257C8.93891 11.8461 8.86711 11.8025 8.85198 11.7949C7.81417 11.219 6.9241 10.5599 6.1816 9.81776C5.43935 9.07515 4.78016 8.18516 4.20444 7.14722C4.19688 7.13206 4.15321 7.06006 4.07373 6.93134C3.99413 6.8025 3.94107 6.71172 3.91457 6.65854C3.88806 6.60557 3.85586 6.52787 3.81805 6.42562C3.78024 6.32337 3.76125 6.2382 3.76125 6.16994C3.76125 6.03366 3.86923 5.85933 4.08516 5.64719C4.30104 5.43517 4.53594 5.23433 4.78964 5.04508C5.04353 4.85583 5.2782 4.64743 5.49416 4.42024C5.71004 4.19294 5.81798 4.00364 5.81798 3.85216C5.81798 3.74617 5.79147 3.63811 5.7385 3.5283C5.68548 3.41825 5.60405 3.28396 5.49416 3.12479C5.38423 2.96571 5.31796 2.8711 5.29519 2.84065C5.18168 2.6514 5.06438 2.44877 4.94303 2.23285C4.82168 2.01697 4.68922 1.77633 4.54522 1.51121C4.40134 1.24622 4.28778 1.0416 4.20436 0.897676C3.93936 0.367484 3.73865 0.079483 3.60225 0.0341892C3.54919 0.0114627 3.46959 0 3.36364 0C3.15898 0 2.89199 0.0378111 2.56248 0.113672C2.23285 0.189414 1.97346 0.268857 1.78405 0.35232C1.40526 0.511326 1.00379 0.973418 0.579505 1.73844C0.193155 2.4504 0 3.15508 0 3.85196C0 4.05634 0.0132538 4.25519 0.0397614 4.44854C0.066269 4.6417 0.113632 4.85953 0.181891 5.102C0.250031 5.34439 0.304997 5.52445 0.346549 5.6417C0.388141 5.75903 0.465793 5.96922 0.579466 6.27235C0.692979 6.5754 0.761238 6.76091 0.783964 6.82909C1.04908 7.57154 1.36347 8.23435 1.72705 8.81772C2.32527 9.78735 3.14163 10.7894 4.17566 11.8235C5.20974 12.8576 6.21161 13.6739 7.18133 14.2724C7.76462 14.6359 8.42766 14.9502 9.17 15.2156C9.23822 15.2382 9.42373 15.3063 9.72666 15.4202C10.0297 15.5338 10.24 15.6114 10.3573 15.6531C10.4747 15.6948 10.6548 15.7498 10.897 15.8181C11.1397 15.8863 11.3573 15.9337 11.5505 15.9604C11.7437 15.9865 11.9426 16 12.147 16C12.8439 16 13.5486 15.8068 14.2607 15.4205C15.0256 14.9963 15.4876 14.5948 15.6467 14.2157C15.7303 14.0265 15.8096 13.767 15.8853 13.4374C15.9613 13.1079 15.999 12.841 15.999 12.6364C15.9993 12.53 15.9879 12.4506 15.965 12.3971Z'
                                      fill='#FA8C16'
                                    />
                                  </g>
                                  <defs>
                                    <clipPath id='clip0_1427_24386'>
                                      <rect width='16' height='16' fill='white' />
                                    </clipPath>
                                  </defs>
                                </svg>
                              </span>
                            </div>
                            <Title className={`${styles.title} ellipsis oneline`} level={3}>
                              Số điện thoại
                            </Title>
                            <Text className={`${styles.desc} ellipsis threeline`}>
                              <Space wrap className={styles.space} size={8}>
                                <Text style={{color: 'white'}}>{formatNumberWithDot('+84369966353')}</Text>
                                <a target='_blank' rel='noreferrer' href={'tel:0369966353'}>
                                  <strong>Gọi ngay</strong>
                                </a>
                              </Space>
                            </Text>
                          </Col>
                          <Col span={24} sm={{ span: 6 }} lg={{ span: 5 }} xl={{ span: 5 }}>
                            <div className={styles.line}>
                              <span className={styles.lineIcon}>
                                <svg
                                  xmlns='http://www.w3.org/2000/svg'
                                  width='18'
                                  height='18'
                                  viewBox='0 0 18 18'
                                  fill='none'
                                >
                                  <path
                                    d='M17.8394 3.57648L12.3804 9.00035L17.8394 14.4242C17.9381 14.218 17.998 13.9899 17.998 13.7464V4.25425C17.998 4.01073 17.9381 3.78274 17.8394 3.57648Z'
                                    fill='#FA8C16'
                                  />
                                  <path
                                    d='M16.417 2.67188H1.58102C1.33749 2.67188 1.10951 2.73175 0.903244 2.83043L7.88046 9.77249C8.49738 10.3894 9.5006 10.3894 10.1175 9.77249L17.0947 2.83043C16.8885 2.73175 16.6605 2.67188 16.417 2.67188Z'
                                    fill='#FA8C16'
                                  />
                                  <path
                                    d='M0.158555 3.57648C0.0598711 3.78274 0 4.01073 0 4.25425V13.7464C0 13.99 0.0598711 14.218 0.158555 14.4242L5.61758 9.00035L0.158555 3.57648Z'
                                    fill='#FA8C16'
                                  />
                                  <path
                                    d='M11.6357 9.7464L10.8632 10.5189C9.83529 11.5468 8.16266 11.5468 7.13472 10.5189L6.36227 9.7464L0.903244 15.1703C1.10951 15.269 1.33749 15.3288 1.58102 15.3288H16.417C16.6605 15.3288 16.8885 15.269 17.0947 15.1703L11.6357 9.7464Z'
                                    fill='#FA8C16'
                                  />
                                </svg>
                              </span>
                            </div>
                            <Title className={`${styles.title} ellipsis oneline`} level={3}>
                              Email
                            </Title>
                            <Text className={`${styles.desc} ellipsis threeline`}>
                              <Space wrap className={styles.space} size={8}>
                                <Text style={{color: 'white'}}>support@cybermovies.vn</Text>
                                <a target='_blank' rel='noreferrer' href={'mailto:support@cybermovies.vn'}>
                                  <strong>Gửi email</strong>
                                </a>
                              </Space>
                            </Text>
                          </Col>
                        </Row>
                      </Col>
                    </Row>
                  </Col>
                </Row>
              </div>
            </div>
          </div>
          <div className='home-container'>
            <div className='home-wrapper'>
              <Row gutter={[12, 0]} className={styles.content}>
                <Col span={24} lg={{ span: 12 }} className={styles.formGroup}>
                  <Col span={24} xl={{ span: 20 }} lg={{ span: 22 }}>
                    <Title className={styles.title} level={2}>
                        Kết nối với chúng tôi
                    </Title>
                    <Form form={form} onFinish={onFinish} className={styles.form} layout='vertical'>
                      <Row gutter={[24, 0]}>
                        <Col span={12}>
                          <Form.Item
                            rules={[{ required: true, message: 'Vui lòng nhập họ tên' }]}
                            label='Họ tên'
                            name='name'
                          >
                            <Input placeholder='Điền họ và tên' />
                          </Form.Item>
                        </Col>
                        <Col span={12}>
                          <Form.Item
                            rules={[
                              {
                                required: true,
                                message: 'Vui lòng nhập số điện thoại',
                              },
                              {
                                pattern: regexPhoneNumber,
                                message: 'Số điện thoại không hợp lệ',
                              },
                            ]}
                            label='Số điện thoại'
                            name='phone'
                          >
                            <PhoneInput
                              inputClass='phone-input'
                              buttonClass='phone-input-button'
                              country='vn'
                              enableSearch
                              containerStyle={{ width: '100%' }}
                              inputStyle={{ width: '100%' }}
                              placeholder='Nhập số điện thoại'
                            />
                          </Form.Item>
                        </Col>
                        <Col span={12}>
                          <Form.Item
                            rules={[
                              {
                                required: true,
                                message: 'Vui lòng nhập email',
                              },
                              { pattern: regexEmail, message: 'Email không hợp lệ' },
                            ]}
                            label='Email'
                            name='email'
                          >
                            <Input placeholder='Điền Email' />
                          </Form.Item>
                        </Col>
                        <Col className={styles.note} span={24}>
                          <Form.Item
                            rules={[
                              {
                                required: true,
                                message: 'Vui lòng nhập lời nhắn',
                              },
                            ]}
                            label='Lời nhắn'
                            name='content'
                          >
                            <TextArea rows={4} placeholder='Điền lời nhắn của bạn đến đội ngũ CyberMovies' />
                          </Form.Item>
                        </Col>
                        <Col span={24} style={{paddingBottom: '35px'}}>
                          <Form.Item>
                            <Button htmlType='submit' className={styles.btn} type='primary'>
                              Gửi thông tin
                            </Button>
                          </Form.Item>
                        </Col>
                      </Row>
                    </Form>
                  </Col>
                </Col>
                <Col span={24} lg={{ span: 12 }} className={styles.map}>
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.3694884690126!2d105.77883417484875!3d21.017896888152354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313455c862f3aee1%3A0x53602e8d02ec1d24!2zVG_DoCBOaMOgIFPDtG5nIMSQw6A!5e0!3m2!1svi!2s!4v1690969765177!5m2!1svi!2s" width='100%' height="600"></iframe>
                </Col>
              </Row>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

export default ContactScreen;
