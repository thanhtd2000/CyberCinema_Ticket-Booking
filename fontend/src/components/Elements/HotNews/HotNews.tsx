import React from 'react';
import { Row, Col, Typography, Tag } from 'antd';
import Image from 'next/image';
import Link from 'next/link';

import { ConvertDate } from '@/libs/common';
import { TPost } from '@modules/post';

import style from './style.module.less';
export interface IHotNew {
  listPost: TPost[];
}
const { Title, Paragraph } = Typography;
function HotNews({ listPost }: IHotNew) {
  return (
    <Link href={`/post/${listPost[0]?.slug ? listPost[0]?.slug : '/#'}`}>
      <Row gutter={[{ xs: 0, sm: 40, md: 40, lg: 83 }, 0]}>
        <Col xs={24} sm={24} md={14} lg={14}>
          <div className={style.PostLeft}>
            <Image src={listPost?.[0].thumbnail.location} width={625} height={416} alt={listPost?.[0].thumbnail.name} />
          </div>
        </Col>
        <Col xs={24} sm={24} md={10} lg={10} className={style.PostRight}>
          <Row>
            <Col span={24}>
              <Tag className={style.tag}>Tin nổi bật</Tag>
              <Tag className={style.tag}>Startup</Tag>
            </Col>
            <Col span={24}>
              <Title level={3}>{listPost?.[0].name}</Title>
            </Col>
            <Col span={24}>
              <Paragraph className={style.text}>{listPost?.[0].excerpt}</Paragraph>
            </Col>
            <Col span={24} className={style.source}>
              <span>{listPost?.[0].source.name}</span>
              <span>{ConvertDate(listPost?.[0].scheduleAt)}</span>
            </Col>
          </Row>
        </Col>
      </Row>
    </Link>
  );
}

export default HotNews;
