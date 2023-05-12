import React from 'react';
import { Row, Col, Typography } from 'antd';

import style from './style.module.less';

export interface IPostMostView {
  number: number;
  text: string;
}
const { Paragraph } = Typography;
function PostMostView({ number, text }: IPostMostView) {
  return (
    <Row className={style.MostView}>
      <Col span={5}>
        <span className={style.number}>{number}</span>
      </Col>
      <Col span={19}>
        <Paragraph className={style.contentRight}>{text}</Paragraph>
      </Col>
    </Row>
  );
}

export default PostMostView;
