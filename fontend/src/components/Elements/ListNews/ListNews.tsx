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
        <Link href={`/post/${News?.slug ? News?.slug : '/#'}`}>
          <div className='space-align-block'>
            <Space align='start' className={style.newContent}>
              <Row>
                <Col span={24} style={{ overflow: 'hidden', borderRadius: '10px' }}>
                  <Image src={News.thumbnail.location} width={120} height={120} alt='new' />
                </Col>
                <Col span={24}>
                  {News.source.name ? (
                    <Paragraph
                      style={{
                        fontSize: '12px',
                        fontWeight: '600',
                        color: '#BFBFBF',
                        fontFamily: 'SF UI Display',
                        paddingTop: '10px',
                        marginBottom: '0px',
                      }}
                    >
                      Theo : {News.source.name}
                    </Paragraph>
                  ) : (
                    ''
                  )}
                </Col>
              </Row>
              <Row className='mock-block'>
                <Col span={24} style={{ paddingBottom: '8px' }}>
                  {News.taxonomies.map((item) => (
                    <Tag
                      style={{
                        color: 'rgba(47, 97, 230, 0.8)',
                        fontSize: '12px',
                        background: 'rgba(47, 97, 230, 0.1)',
                        borderColor: 'rgba(47, 97, 230, 0.1)',
                      }}
                    >
                      {item.name}
                    </Tag>
                  ))}
                </Col>
                <Col span={24}>
                  <Title level={5}>{News.name}</Title>
                </Col>
                <Col span={24}>
                  <Paragraph className={style.infor}>{News.excerpt}</Paragraph>
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
