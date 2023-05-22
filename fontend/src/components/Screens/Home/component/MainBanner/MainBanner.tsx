/* eslint-disable import/order */
import React from 'react';

import style from './style.module.less';

import { Row, Col, Typography, Button } from 'antd';
import { Swiper, SwiperSlide } from 'swiper/react';
import 'swiper/css';
import { Pagination } from 'swiper';
import 'swiper/css/pagination';
import { useTranslation } from 'next-i18next';

const { Title, Paragraph } = Typography;
function MainBanner() {
  const { t } = useTranslation();
  return (
    <div className='container'>
      <div className={style.MainBanner}>
        <Row>
          <Col span={24}>
            <Swiper
              pagination={{
                clickable: true,
              }}
              modules={[Pagination]}
              className='mySwiper'
            >
              <SwiperSlide>
                <div className={style.banner}>
                  <Row className={style.content}>
                    <Col span={8}>
                      <Col span={24}>
                        <Paragraph className={style.text}>{t('find_partner')}</Paragraph>
                      </Col>
                      <Col span={24}>
                        <Title level={3}>Nhanh chóng - Uy tín - Tiết kiệm</Title>
                      </Col>
                      <Col span={24}>
                        <Paragraph className={style.desc}>{t('desc_footer')}</Paragraph>
                      </Col>
                      <Col span={24}>
                        <Button>{t('discovery')}</Button>
                      </Col>
                    </Col>
                  </Row>
                </div>
                <div className={style.bannerMobie}>
                  <Row className={style.content}>
                    <Col span={24}>
                      <Col span={24}>
                        <Paragraph className={style.text}>{t('find_partner')}</Paragraph>
                      </Col>
                      <Col span={24}>
                        <Title level={3}>Nhanh chóng - Uy tín - Tiết kiệm</Title>
                      </Col>
                      <Col span={24}>
                        <Paragraph className={style.desc}>{t('desc_footer')}</Paragraph>
                      </Col>
                      <Col span={24}>
                        <Button>{t('discovery')}</Button>
                      </Col>
                    </Col>
                  </Row>
                </div>
              </SwiperSlide>
              <SwiperSlide>
                <div className={style.banner}>
                  <Row className={style.content}>
                    <Col span={8}>
                      <Col span={24}>
                        <Paragraph className={style.text}>{t('find_partner')}</Paragraph>
                      </Col>
                      <Col span={24}>
                        <Title level={3}>Nhanh chóng - Uy tín - Tiết kiệm</Title>
                      </Col>
                      <Col span={24}>
                        <Paragraph className={style.desc}>{t('desc_footer')}</Paragraph>
                      </Col>
                      <Col span={24}>
                        <Button>{t('discovery')}</Button>
                      </Col>
                    </Col>
                  </Row>
                </div>
                <div className={style.bannerMobie}>
                  <Row className={style.content}>
                    <Col span={24}>
                      <Col span={24}>
                        <Paragraph className={style.text}>{t('find_partner')}</Paragraph>
                      </Col>
                      <Col span={24}>
                        <Title level={3}>Nhanh chóng - Uy tín - Tiết kiệm</Title>
                      </Col>
                      <Col span={24}>
                        <Paragraph className={style.desc}>
                          Trong số hơn +16,000 doanh nghiệp đang phát triển mạnh mẽ tại Việt Nam, cùng iCongTy tìm ra
                          đối tác tiềm năng với doanh nghiệp của bạn.
                        </Paragraph>
                      </Col>
                      <Col span={24}>
                        <Button>{t('discovery')}</Button>
                      </Col>
                    </Col>
                  </Row>
                </div>
              </SwiperSlide>
              <SwiperSlide>
                <div className={style.banner}>
                  <Row className={style.content}>
                    <Col span={8}>
                      <Col span={24}>
                        <Paragraph className={style.text}>Tìm kiếm đối tác</Paragraph>
                      </Col>
                      <Col span={24}>
                        <Title level={3}>Nhanh chóng - Uy tín - Tiết kiệm</Title>
                      </Col>
                      <Col span={24}>
                        <Paragraph className={style.desc}>
                          Trong số hơn +16,000 doanh nghiệp đang phát triển mạnh mẽ tại Việt Nam, cùng iCongTy tìm ra
                          đối tác tiềm năng với doanh nghiệp của bạn.
                        </Paragraph>
                      </Col>
                      <Col span={24}>
                        <Button>Khám phá ngay</Button>
                      </Col>
                    </Col>
                  </Row>
                </div>
                <div className={style.bannerMobie}>
                  <Row className={style.content}>
                    <Col span={24}>
                      <Col span={24}>
                        <Paragraph className={style.text}>Tìm kiếm đối tác</Paragraph>
                      </Col>
                      <Col span={24}>
                        <Title level={3}>Nhanh chóng - Uy tín - Tiết kiệm</Title>
                      </Col>
                      <Col span={24}>
                        <Paragraph className={style.desc}>
                          Trong số hơn +16,000 doanh nghiệp đang phát triển mạnh mẽ tại Việt Nam, cùng iCongTy tìm ra
                          đối tác tiềm năng với doanh nghiệp của bạn.
                        </Paragraph>
                      </Col>
                      <Col span={24}>
                        <Button>Khám phá ngay</Button>
                      </Col>
                    </Col>
                  </Row>
                </div>
              </SwiperSlide>
              <SwiperSlide>
                <div className={style.banner}>
                  <Row className={style.content}>
                    <Col span={8}>
                      <Col span={24}>
                        <Paragraph className={style.text}>Tìm kiếm đối tác</Paragraph>
                      </Col>
                      <Col span={24}>
                        <Title level={3}>Nhanh chóng - Uy tín - Tiết kiệm</Title>
                      </Col>
                      <Col span={24}>
                        <Paragraph className={style.desc}>
                          Trong số hơn +16,000 doanh nghiệp đang phát triển mạnh mẽ tại Việt Nam, cùng iCongTy tìm ra
                          đối tác tiềm năng với doanh nghiệp của bạn.
                        </Paragraph>
                      </Col>
                      <Col span={24}>
                        <Button>Khám phá ngay</Button>
                      </Col>
                    </Col>
                  </Row>
                </div>
                <div className={style.bannerMobie}>
                  <Row className={style.content}>
                    <Col span={24}>
                      <Col span={24}>
                        <Paragraph className={style.text}>Tìm kiếm đối tác</Paragraph>
                      </Col>
                      <Col span={24}>
                        <Title level={3}>Nhanh chóng - Uy tín - Tiết kiệm</Title>
                      </Col>
                      <Col span={24}>
                        <Paragraph className={style.desc}>
                          Trong số hơn +16,000 doanh nghiệp đang phát triển mạnh mẽ tại Việt Nam, cùng iCongTy tìm ra
                          đối tác tiềm năng với doanh nghiệp của bạn.
                        </Paragraph>
                      </Col>
                      <Col span={24}>
                        <Button>Khám phá ngay</Button>
                      </Col>
                    </Col>
                  </Row>
                </div>
              </SwiperSlide>
            </Swiper>
          </Col>
        </Row>
      </div>
    </div>
  );
}

export default MainBanner;
