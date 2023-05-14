import React from 'react';
import { Col, Row, Space, Typography, Tag } from 'antd';
import Image from 'next/image';
import { AiOutlineCopy } from 'react-icons/ai';
import Link from 'next/link';

import { TCompany } from '@/modules/company';

import style from './style.module.less';

const { Paragraph, Title } = Typography;
export interface listCompanyLine {
  listCompanyLine: TCompany;
}
function ListCompanyLine({ listCompanyLine }: listCompanyLine) {
  return (
    <Link href={`/company/${listCompanyLine?.slug ? listCompanyLine?.slug : '/#'}`}>
      <Row className={style.companyLine}>
        <Col sm={16} md={14} lg={11}>
          <Row className={style.name}>
            <Image src={listCompanyLine.logo.location} width={74} height={74} alt='LogoCompany' />
            <Title level={4}>{listCompanyLine.name}</Title>
          </Row>
        </Col>
        <Col lg={4}>
          {listCompanyLine.taxCode ? (
            <Space>
              <Paragraph className={style.tax}>{listCompanyLine.taxCode}</Paragraph>
              <span>
                <AiOutlineCopy />
              </span>
            </Space>
          ) : (
            <Space>
              <Paragraph>--</Paragraph>
            </Space>
          )}
        </Col>
        <Col md={5} lg={5}>
          <Row style={{ display: 'flex', flexWrap: 'nowrap' }}>
            {listCompanyLine.categories.length > 1
              ? listCompanyLine.categories.slice(0, 1).map((item) => (
                <Col style={{ display: 'flex', flexWrap: 'nowrap' }}>
                    <Tag className={style.category}>{item.name}</Tag>
                    <Tag className={style.category}>+ {listCompanyLine.categories.length - 1}</Tag>
                  </Col>
              ))
              : listCompanyLine.categories.map((item) => (
                <Col>
                    <Tag className={style.category}>{item.name}</Tag>
                  </Col>
              ))}
          </Row>
        </Col>
        <Col sm={8} md={5} lg={4}>
          <Space className={style.location}>
            <Image src='/images/Frame (12).png' width={12} height={12} alt='location' />
            <Title level={5}>{listCompanyLine.city.name}</Title>
          </Space>
        </Col>
      </Row>
    </Link>
  );
}

export default ListCompanyLine;
