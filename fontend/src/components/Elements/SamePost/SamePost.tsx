import React from 'react';
import { Row, Col, Typography, Tag } from 'antd';
import Image from 'next/image';

import { TPost } from '@/modules/post';

import style from './style.module.less';

export interface ISamePost {
  fetchAllNewByCategory: TPost;
}
const { Title, Paragraph } = Typography;
function SamePost({ fetchAllNewByCategory }: ISamePost) {
  return (
    <Row className={style.samePost} gutter={[24, 0]}>
      <Col xs={24} sm={8} md={8}>
        <div style={{ overflow: 'hidden', borderRadius: '15px' }}>
          <Image src={fetchAllNewByCategory.thumbnail.location} width={271} height={181} alt='new' />
        </div>
      </Col>
      <Col xs={24} sm={16} md={16} style={{ display: 'flex', alignItems: 'center' }}>
        <Row>
          <Col span={24} style={{ paddingLeft: '15px' }}>
            {fetchAllNewByCategory.taxonomies.map((item) => (
              <Tag className={style.tag}>{item.name}</Tag>
            ))}
          </Col>
          <Col span={24}>
            <Title level={5}>{fetchAllNewByCategory.name}</Title>
          </Col>
          <Col span={24}>
            <Paragraph className={style.content}>{fetchAllNewByCategory.excerpt}</Paragraph>
          </Col>
        </Row>
      </Col>
    </Row>
  );
}

export default SamePost;
