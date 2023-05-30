/* eslint-disable jsx-a11y/anchor-is-valid */
import React from 'react';
import { Row, Col, Typography } from 'antd';
import Image from 'next/image';
import Link from 'next/link';
import { FaFacebookF, FaLinkedinIn, FaTwitter } from 'react-icons/fa';
import { useTranslation } from 'next-i18next';

import style from './style.module.less';

const { Title, Paragraph } = Typography;
function Footer() {
  const { t } = useTranslation();

  return (
    <div style={{ background: '#151728' }}>
      <div className='container'>
        <div className={style.footer}>
          <Row>
            <Col span={24} style={{ paddingBottom: '48px' }}>
              <Row gutter={[{ xs: 0, sm: 0, md: 0, lg: 81 }, 24]}>
                <Col xs={24} sm={24} md={24} lg={9} xl={9}>
                  <Row>
                    <Col span={24}>
                      <Image src='/images/logoCyberMovies.png' width={100} style={{objectFit: 'contain'}} height={100} alt='logo' />
                    </Col>
                    <Col span={24}>
                      <Paragraph className={style.desc}>Cyber Movies một trong những rạp chiếu phim có lượng khách hàng lớn cũng như có dịch vụ chu đáo giúp khách hàng có những trải nghiệm tuyệt vời</Paragraph>
                    </Col>
                    <Col span={24}>
                      <Paragraph className={style.address}>
                        {t('address')}: T21A - Tòa nhà Sông Đà - Mỹ Đình 1 - Nam Từ Liêm - Hà Nội
                      </Paragraph>
                    </Col>
                    <Col span={24}>
                      <Paragraph className={style.email}>Email: support@cybermovies.vn</Paragraph>
                    </Col>
                  </Row>
                </Col>
                <Col xs={24} sm={24} md={24} lg={15} xl={15}>
                  <Row gutter={[{ xs: 0, sm: 0, md: 20 }, 0]}>
                    <Col xs={24} sm={8} md={8} lg={8}>
                      <Row className={style.company}>
                        <Col span={24}>
                          <Title level={5}>Cyber Movies</Title>
                        </Col>
                        <Col span={24} style={{ paddingBottom: '17px' }}>
                          <Link href='/'>Về Cyber Movies</Link>
                        </Col>
                        <Col span={24} style={{ paddingBottom: '17px' }}>
                          <Link href='/'>Liên hệ</Link>
                        </Col>
                        <Col span={24} style={{ paddingBottom: '17px' }}>
                          <Link href='/'>Phim</Link>
                        </Col>
                        <Col span={24} style={{ paddingBottom: '17px' }}>
                          <Link href='/'>Rạp</Link>
                        </Col>
                        <Col span={24} style={{ paddingBottom: '17px' }}>
                          <Link href='/'>Thông báo tin tức</Link>
                        </Col>
                      </Row>
                    </Col>
                    <Col xs={24} sm={8} md={8} lg={8}>
                      <Row className={style.company}>
                        <Col span={24}>
                          <Title level={5}>Thành viên khách hàng</Title>
                        </Col>
                        <Col span={24} style={{ paddingBottom: '17px' }}>
                          <Link href='/'>Tham gia thành viên</Link>
                        </Col>
                        <Col span={24} style={{ paddingBottom: '17px' }}>
                          <Link href='/'>Điều khoản thành viên</Link>
                        </Col>
                        <Col span={24} style={{ paddingBottom: '17px' }}>
                          <Link href='/'>Vấn đề thường gặp</Link>
                        </Col>
                        <Col span={24} style={{ paddingBottom: '17px' }}>
                          <Link href='/'>Sửa đổi hồ sơ thành viên</Link>
                        </Col>
                      </Row>
                    </Col>
                    <Col xs={24} sm={8} md={8} lg={8}>
                      <Row className={style.company}>
                        <Col span={24}>
                          <Title level={5}>Điều khoản</Title>
                        </Col>
                        <Col span={24} style={{ paddingBottom: '17px' }}>
                          <Link href='/'>Điều khoản đăng ký thành viên</Link>
                        </Col>
                        <Col span={24} style={{ paddingBottom: '17px' }}>
                          <Link href='/'>Điều khoản dịch vụ</Link>
                        </Col>
                      </Row>
                    </Col>
                  </Row>
                </Col>
              </Row>
            </Col>
            <Col span={24}>
              <div className={style.footerBottom}>
                <div>
                  <Link href=''>
                    <FaFacebookF className={style.social} />
                  </Link>
                  <Link href=''>
                    <FaLinkedinIn className={style.social} />
                  </Link>
                  <Link href=''>
                    <FaTwitter className={style.social} />
                  </Link>
                </div>
                <Paragraph className={style.dev}>
                  © 2023 - 2030 Cyber®
                </Paragraph>
              </div>
            </Col>
          </Row>
        </div>
      </div>
    </div>
  );
}

export default Footer;
