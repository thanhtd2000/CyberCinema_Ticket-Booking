import React, { useState } from 'react';
import { Col, Row, Typography, Button } from 'antd';
import { Swiper, SwiperSlide } from 'swiper/react';
import { FcPrevious, FcNext } from 'react-icons/fc';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import { Navigation } from 'swiper';
import Link from 'next/link';
import { useTranslation } from 'next-i18next';

import ListNews from '@/components/Elements/ListNews/ListNews';
import MainNews from '@/components/Elements/MainNew/MainNews';
import { TPost } from '@/modules/post';

import style from './style.module.less';

const { Title } = Typography;
export interface IHotNews {
  HotNews: TPost[];
  News: TPost[];
}
function New({ HotNews, News }: IHotNews) {
  const { t } = useTranslation();
  const [swipe, setSwipe] = useState<any>();
  return (
    <div className='container'>
      <div className={style.new}>
        <Row gutter={[{ xs: 0, sm: 0, md: 64 }, 0]}>
          <Col xs={24} sm={24} md={24} lg={15} xl={15}>
            <Row>
              <Col span={24} style={{ paddingBottom: '42px' }}>
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
                    <Link href={`/post/${item?.slug ? item?.slug : '/#'}`}>
                      <SwiperSlide className={style.slide}>
                        <MainNews HotNews={item} />
                      </SwiperSlide>
                    </Link>
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
            <Row style={{ paddingTop: '53px' }}>
              <Col span={24} className={style.button}>
                <Title level={3}>{t('list_news')}</Title>
                <Button>{t('view_all')}</Button>
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
      </div>
    </div>
  );
}

export default New;
