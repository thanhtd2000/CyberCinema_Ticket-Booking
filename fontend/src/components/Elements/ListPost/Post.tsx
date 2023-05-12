import React from 'react';
import { Col, Row, Typography, Tag } from 'antd';
import Image from 'next/image';

import { TPost } from '@/modules/post';

import style from './style.module.less';

export interface Ipost {
  listPostSearch: TPost;
}
const { Title, Paragraph } = Typography;
export default function Post({ listPostSearch }: Ipost) {
  return (
    <Row className={style.Post} gutter={[24, 0]}>
      <Col xs={24} sm={24} md={16} lg={16}>
        <Row>
          <Col span={24}>
            {listPostSearch.categories ? (
              listPostSearch?.taxonomies.map((item) => <Tag className={style.tag}>{item.name}</Tag>)
            ) : (
              <Tag style={{ marginTop: '32px' }} className={style.tag} />
            )}
          </Col>
          <Col span={24}>
            <Title level={4}>{listPostSearch.name}</Title>
          </Col>
          <Col span={24}>
            <Paragraph className={style.paragraph}>{listPostSearch.excerpt}</Paragraph>
          </Col>
        </Row>
      </Col>
      <Col xs={24} sm={24} md={8} lg={8}>
        <div style={{ overflow: 'hidden', borderRadius: '15px' }}>
          <Image src={listPostSearch.thumbnail.location} width={271} height={181} alt='new' />
        </div>
      </Col>
    </Row>
  );
}
