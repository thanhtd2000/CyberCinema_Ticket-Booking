import React from 'react';
import { Col, Row, Tag, Typography } from 'antd';
import Image from 'next/image';
import Link from 'next/link';

import { TPost } from '@/modules/post';

import style from './style.module.less';

const { Title, Paragraph } = Typography;
export interface IHotNews {
  HotNews: TPost;
}
function MainNews({ HotNews }: IHotNews) {
  return (
    <Row>
      <Col span={24} className={style.newPatch}>
        {HotNews.taxonomies.map((item) => (
          <Tag style={{ background: 'rgba(47, 97, 230, 0.1)', borderColor: 'rgba(47, 97, 230, 0.1)' }}>
            <Link href='/'>{item.name}</Link>
          </Tag>
        ))}
      </Col>
      <Col span={24}>
        <Row className={style.story} gutter={[{ xs: 0, sm: 30, md: 72 }, 0]}>
          <Col xs={24} sm={14} md={14}>
            <Title level={3}>{HotNews.name}</Title>
          </Col>
          <Col xs={24} sm={10} md={10}>
            <Row>
              <Col span={24}>
                <p>Tiếp theo:</p>
              </Col>
              <Col span={24}>
                <Paragraph className={style.text}>{HotNews.excerpt}</Paragraph>
              </Col>
            </Row>
          </Col>
        </Row>
      </Col>
      <Col span={24} style={{ borderRadius: '15px', overflow: 'hidden' }}>
        <Image className={style.image} src={HotNews.thumbnail.location} width={684} height={456} alt='new' />
      </Col>
    </Row>
  );
}

export default MainNews;
