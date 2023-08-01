import React, { useState } from 'react';
import { Col, Row, Typography, Button } from 'antd';
import { Swiper, SwiperSlide } from 'swiper/react';
import { FcPrevious, FcNext } from 'react-icons/fc';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import { Navigation } from 'swiper';
import Link from 'next/link';

import ListNews from '@/components/Elements/ListNews/ListNews';
import { TPost } from '@/modules/post';

import style from './style.module.less';
import Image from 'next/image';

const { Title } = Typography;
export interface IHotNews {
  HotNews: TPost[];
  News: TPost[];
}
function New({ HotNews, News }: IHotNews) {
  const [swipe, setSwipe] = useState<any>();
  return (
    <div className='container'>
      <div className={style.new}>
        <Row>
          <Col span={24}>
            <Title level={3}>Tin tức nổi bật</Title>
          </Col>
          <Col span={24}>
            <Row gutter={[{ xs: 0, sm: 0, md: 64 }, 24]}>
              <Col xs={24} sm={24} md={24} lg={15} xl={15}>
                <Row>
                  <Col span={24} style={{ paddingBottom: '20px' }}>
                    <Swiper
                      onInit={(swiper) => {
                        setSwipe(swiper);
                        swiper.navigation.init();
                        swiper.navigation.update();
                      }}
                      navigation={false}
                      modules={[Navigation]}
                      spaceBetween={50}
                    >
                      {HotNews.map((item) => (
                        <SwiperSlide className={style.slide}>
                          <Link href={`/news/${item?.slug ? item?.slug : '/#'}`}>
                            <Row>
                              <Col span={24}>
                                <Image src={item?.image} width={700} height={456} alt='logoNew' />
                              </Col>
                              <Col span={24}>
                                <Title level={4}>{item?.name}</Title>
                              </Col>
                            </Row>
                          </Link>
                        </SwiperSlide>
                      ))}
                    </Swiper>
                  </Col>
                  <Col span={24}>
                    <div>
                      <Button className={style.prev} onClick={() => swipe?.slidePrev()}>
                        <FcPrevious />
                      </Button>
                      <Button className={style.next} onClick={() => swipe?.slideNext()}>
                        <FcNext />
                      </Button>
                    </div>
                  </Col>
                </Row>
              </Col>
              <Col xs={24} sm={24} md={24} lg={9} xl={9}>
                <Row>
                  <Col span={24} className={style.button}>
                    <Title level={3}>Tin tức</Title>
                    <Button href='/news'>Xem thêm</Button>
                  </Col>
                  <Col span={24}>
                    <Row gutter={[0, 16]}>
                      {News.map((item) => (
                        <ListNews News={item} />
                      ))}
                    </Row>
                  </Col>
                </Row>
              </Col>
            </Row>
          </Col>
        </Row>
      </div>
    </div>
  );
}

export default New;
