import React from 'react';
import { Col, Row, Typography, Space, Tag, Skeleton } from 'antd';
import Image from 'next/image';
import Link from 'next/link';

import { TPost } from '@/modules/post';

import style from './style.module.less';

const { Title, Paragraph } = Typography;
export interface INews {
  News: TPost;
}
function ListNews({ News }: INews) {
  return (
    <Col span={24}>
      {News && News ? (
        <Link href={`/news/${News?.slug ? News?.slug : '/#'}`}>
          <div className='space-align-block'>
            <Space align='start' className={style.newContent}>
              <Row>
                <Col span={24} style={{ overflow: 'hidden', borderRadius: '10px' }}>
                  <Image src={News.image} width={120} height={120} alt='new' />
                </Col>
              </Row>
              <Row className='mock-block' style={{justifyContent: 'space-between', height: '110px'}}>
                <Col span={24}>
                  <Title level={5}>{News.name}</Title>
                </Col>
                <Col span={24} className={style.editor}>
                  <p>Edit by: <span>{News?.user[0]?.name}</span></p>
                </Col>
              </Row>
            </Space>
          </div>
        </Link>
      ) : (
        <Skeleton />
      )}
    </Col>
  );
}

export default ListNews;
