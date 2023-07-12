import { Breadcrumb, Col, Row } from 'antd';
import Link from 'next/link';
import React from 'react';
import style from './style.module.less'
import ReactHtmlParser from 'react-html-parser';
interface INewDetailScreen {
  fetchNewDetail: any;
}
function NewDetailScreen({ fetchNewDetail }: INewDetailScreen) {
      console.log(fetchNewDetail);
  return (
    <Row className={style.NewDetail}>
      <Col span={24}>
        <Breadcrumb
          style={{ color: 'rgb(183, 177, 177)', paddingBottom: '30px', fontSize: '17px' }}
          items={[
            {
              title: (
                <Link style={{ color: '#999' }} href='/'>
                  Home
                </Link>
              ),
            },
            {
                  title: (
                    <Link style={{ color: '#999' }} href='/news'>
                      News
                    </Link>
                  ),
                },
            {
              title: (
                <p style={{ color: '#999' }}>
                  {fetchNewDetail[0]?.name}
                </p>
              ),
            },
          ]}
        />
      </Col>
      <Col span={24} className={style.content}>
          {ReactHtmlParser(fetchNewDetail[0]?.content)}
      </Col>
    </Row>
  );
}

export default NewDetailScreen;
