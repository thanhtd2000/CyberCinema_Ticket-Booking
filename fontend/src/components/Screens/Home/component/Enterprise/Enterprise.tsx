import React, { useState } from 'react';
import { Typography, Pagination, Row, Col, Button, Spin } from 'antd';
import { useRouter } from 'next/router';
import { useTranslation } from 'next-i18next';

import ListEnterprise from '@/components/Elements/ListEnterprise/ListEnterprise';
import { queryAllCompany } from '@/queries/hooks/company';
import { baseParams } from '@/configs/const.config';
import { GET_LIST_COMPANY } from '@/queries/keys/company';
import { ELanguage } from '@/configs/interface.config';

import style from './style.module.less';

const { Title } = Typography;

function Enterprise() {
  const router = useRouter();
  const { t } = useTranslation();
  const [pageCompany, setPageCompany] = useState(1);
  const { data: ListCompany } = queryAllCompany(
    {
      ...baseParams,
      limit: 9,
      typical: 0,
      page: pageCompany,
      lang: router.locale as ELanguage,
    },
    GET_LIST_COMPANY,
  );
  return (
    <div className='container'>
      <div className={style.enterprise}>
        <Row>
          <Col span={24} className={style.title}>
            <Title level={4}>{t('new_enterprise')}</Title>
            <Button>{t('view_all')}</Button>
          </Col>
          <Col span={24}>
            <Row gutter={[26, 32]} style={{ justifyContent: 'center', alignItems: 'center' }}>
              {ListCompany?.data && ListCompany?.data ? (
                ListCompany.data.map((item) => <ListEnterprise ListCompany={item} />)
              ) : (
                <Spin />
              )}
            </Row>
          </Col>
          <Col span={24} style={{ display: 'flex', justifyContent: 'center', paddingTop: '48px' }}>
            <Row>
              <Col>
                <Pagination
                  onChange={(page) => setPageCompany(page)}
                  current={pageCompany || 1}
                  hideOnSinglePage
                  defaultCurrent={1}
                  total={Math.ceil(((ListCompany?.total || 0) * 10) / 9)}
                />
              </Col>
            </Row>
          </Col>
        </Row>
      </div>
    </div>
  );
}

export default Enterprise;
