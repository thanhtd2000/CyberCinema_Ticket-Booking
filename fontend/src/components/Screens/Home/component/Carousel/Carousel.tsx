import React from 'react';
import { Col, Row, Typography, Button } from 'antd';
import { AiFillStar } from 'react-icons/ai';
import { BsTicketDetailed } from 'react-icons/bs';
import 'swiper/css/navigation';

import style from './style.module.less';
const { Title, Paragraph } = Typography
function Carousel () {
  return (
    <div className='carousel'>
      <Row className={style.content}>
        <Col span={24} className={style.bannerItem}>
          <video src='/videos/insidious.mp4' style={{ width: '100%' }} autoPlay loop muted />
          <Row className={style.content}>
            <Col span={24} className={style.start}>
              <ul>
                <li>
                  <AiFillStar />
                </li>
                <li>
                  <AiFillStar />
                </li>
                <li>
                  <AiFillStar />
                </li>
                <li>
                  <AiFillStar />
                </li>
                <li>
                  <AiFillStar />
                </li>
              </ul>
            </Col>
            <Col span={24}>
              <Title level={3}>Quỷ quyệt: Cửa đỏ vô định</Title>
            </Col>
            <Col span={24}>
              <Paragraph className={style.name}>2D Digital</Paragraph>
            </Col>
            <Col span={24}>
              <Button className={style.trailer} icon={<BsTicketDetailed />}>
                Đặt vé ngay
              </Button>
            </Col>
          </Row>
        </Col>
      </Row>
    </div>
  );
}

export default Carousel;
