import React from 'react';
import { Row, Col, Typography } from 'antd';

import { TCategory } from '@/modules/category';

import style from './style.module.less';

export interface IJobs {
  listAllCategory: TCategory;
}
const { Title } = Typography;
function ListJobs({ listAllCategory }: IJobs) {
  const truncateString = (str: string, num: number) => {
    if (str?.length > num) {
      return `${str.slice(0, num)} ...`;
    }
    return str;
  };
  return (
    <Col xs={24} sm={12} md={8} lg={8} xl={6}>
      <Row className={style.job}>
        <Col>
          <Title level={3}>{truncateString(listAllCategory.name, 20)}</Title>
        </Col>
        <Col>
          <span>{listAllCategory.companyCount}</span>
        </Col>
      </Row>
    </Col>
  );
}

export default ListJobs;
