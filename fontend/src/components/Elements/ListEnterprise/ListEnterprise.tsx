import React from 'react';
import { Typography, Tag, Row, Col, Space } from 'antd';
import { AiOutlineCopy } from 'react-icons/ai';
import Image from 'next/image';

import { TCompany } from '@/modules/company';

import style from './style.module.less';

export interface IEnterprise {
  ListCompany: TCompany;
}
const { Title, Paragraph } = Typography;
function ListEnterprise({ ListCompany }: IEnterprise) {
  return (
    <Col xs={24} sm={12} md={12} lg={8} xl={8} className={style.cardNew}>
      <div className='space-align-block'>
        <Space align='start' className={style.card}>
          <Image src={ListCompany.logo.location} width={64} height={64} alt='logo' />
          <Row className='mock-block'>
            <Col span={24}>
              <Title className={style.name} level={5}>
                {ListCompany.name}
              </Title>
            </Col>
            <Col span={24} style={{ display: 'flex', alignItems: 'center' }}>
              <Paragraph className={style.tax}>Mã số thuế: {ListCompany.taxCode}</Paragraph>
              <span className={style.copy}>
                <AiOutlineCopy />
              </span>
            </Col>
            <Col span={24}>
              <Row>
                {ListCompany.categories.length > 2
                  ? ListCompany.categories.slice(0, 1).map((item) => (
                      <Col>
                      <Tag className={style.tag}>{item.name}</Tag>
                      <Tag className={style.tag}>+ {ListCompany.categories.length - 1}</Tag>
                    </Col>
                    ))
                  : ListCompany.categories.map((item) => (
                      <Col>
                      <Tag className={style.tag}>{item.name}</Tag>
                    </Col>
                    ))}
              </Row>
            </Col>
          </Row>
        </Space>
      </div>
    </Col>
  );
}

export default ListEnterprise;
