import React from 'react';
import { Row, Col, Typography, Tag } from 'antd';
import Image from 'next/image';
import Link from 'next/link';

import { TPost } from '@modules/post';

import style from './style.module.less';

const { Title, Paragraph } = Typography;
// export interface IListHotNews {
//   title: string;
//   desc: string;
// }
export interface IListHotNews {
  listPost: TPost;
}
function ListHotNews({ listPost }: IListHotNews) {
  return (
    <Col xs={24} sm={12} md={12} lg={8}>
      <Link href={`/post/${listPost?.slug ? listPost?.slug : '/#'}`}>
        <Row className={style.PostItem}>
          <Col span={24} style={{ overflow: 'hidden', borderRadius: '15px', marginBottom: '32px' }}>
            <Image src={listPost.thumbnail.location} width={330} height={220} alt='new' />
          </Col>
          <Col span={24}>
            {listPost.categories ? (
              listPost?.categories.map((item) => <Tag className={style.tag}>{item.name}</Tag>)
            ) : (
              <Tag style={{ marginTop: '32px' }} className={style.tag} />
            )}
          </Col>
          <Col span={24}>
            <Title level={5}>{listPost?.name}</Title>
          </Col>
          <Col span={24}>
            <Paragraph className={style.text}>{listPost?.excerpt}</Paragraph>
          </Col>
        </Row>
      </Link>
    </Col>
  );
}

export default ListHotNews;
