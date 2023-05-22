import React from 'react';
import { Row, Col, Typography, Card, Tag } from 'antd';
import Image from 'next/image';
import moment from 'moment';

import { TCompany } from '@/modules/company';

import style from './style.module.less';
import Link from 'next/link';

const { Title, Paragraph } = Typography;
export interface ITypicalCompany {
  listTypicalCompany: TCompany;
}
function ListCompany({ listTypicalCompany }: ITypicalCompany) {
  return (
    <Col xs={24} sm={12} md={12} lg={8} xl={8}>
      <Link href={`/company/${listTypicalCompany?.slug ? listTypicalCompany?.slug : '/#'}`}>
        <Card className={style.card}>
          <Row>
            <Col span={24} className={style.ImageCard}>
              <Image src={listTypicalCompany.coverPhoto.location} width={320} height={92} alt='company' />
              <Col className={style.imageLogo}>
                <Image src={listTypicalCompany.logo.location} width={76} height={76} alt='company' />
              </Col>
            </Col>
            <Col span={24}>
              <Title level={5}>{listTypicalCompany.name}</Title>
            </Col>
            <Col span={24}>
              <Row gutter={[8, 0]} style={{ paddingBottom: '16px' }}>
                {listTypicalCompany.categories.length > 2
                  ? listTypicalCompany.categories.slice(0, 1).map((item) => (
                      <Col style={{ display: 'flex', flexWrap: 'nowrap' }}>
                      <Tag className={style.category}>{item.name}</Tag>
                      <Tag className={style.category}>+ {listTypicalCompany.categories.length - 1}</Tag>
                    </Col>
                    ))
                  : listTypicalCompany.categories.map((item) => (
                      <Col>
                      <Tag className={style.category}>{item.name}</Tag>
                    </Col>
                    ))}
              </Row>
            </Col>
            <Col span={24} style={{ borderTop: '1px solid rgba(0, 0, 0, 0.06)' }} className={style.infor}>
              <Row style={{ paddingTop: '8px' }}>
                <Col xs={12} sm={14} md={12}>
                  <Image src='/images/Frame (6).png' width={12} height={12} alt='company' />
                  <strong>Địa điểm</strong>
                </Col>
                <Col xs={12} sm={10} md={12} style={{ display: 'flex', alignItems: 'center' }}>
                  <Paragraph className={style.provide}>{listTypicalCompany.city.name}</Paragraph>
                </Col>
              </Row>
            </Col>
            <Col span={24} className={style.infor}>
              <Row style={{ padding: '6px 0' }}>
                <Col xs={12} sm={14} md={12}>
                  <Image src='/images/Frame (5).png' width={12} height={12} alt='company' />
                  <strong>Năm thành lập</strong>
                </Col>
                <Col xs={12} sm={10} md={12} style={{ display: 'flex', alignItems: 'center' }}>
                  {listTypicalCompany.foundationDate ? (
                    <Paragraph
                      style={{ fontSize: '12px', fontFamily: 'SF UI  Text', fontWeight: '400', marginBottom: '0px' }}
                    >
                      {moment(listTypicalCompany.foundationDate).format('y')}
                    </Paragraph>
                  ) : (
                    <Paragraph
                      style={{ fontSize: '12px', fontFamily: 'SF UI  Text', fontWeight: '400', marginBottom: '0px' }}
                    >
                      --
                    </Paragraph>
                  )}
                </Col>
              </Row>
            </Col>
            <Col span={24} className={style.infor}>
              <Row>
                <Col xs={12} sm={14} md={12}>
                  <Image src='/images/team.png' width={12} height={12} alt='company' />
                  <strong>Quy mô</strong>
                </Col>
                <Col xs={12} sm={10} md={12} style={{ display: 'flex', alignItems: 'center' }}>
                  <Paragraph className={style.size}>--</Paragraph>
                </Col>
              </Row>
            </Col>
          </Row>
        </Card>
      </Link>
    </Col>
  );
}

export default ListCompany;
