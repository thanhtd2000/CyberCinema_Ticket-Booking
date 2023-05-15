import React, { useState } from 'react';
import { Row, Col, Typography, Pagination, Spin, Empty } from 'antd';
import { useRouter } from 'next/router';
import { useTranslation } from 'next-i18next';

import ListCompany from '@/components/Elements/ListCompany/ListCompany';
import { queryAllCompany } from '@/queries/hooks/company';
import { baseParams } from '@/configs/const.config';
import { ELanguage } from '@/configs/interface.config';
import { GET_LIST_TYPICAL_COMPANY } from '@/queries/keys/company';

import style from './style.module.less';

const { Title, Paragraph } = Typography;
function Company() {
  const router = useRouter();
  const { t } = useTranslation('common');
  const [pageTypical, setPageTypical] = useState(1);
  const { data: listTypicalCompany, isLoading: Loading } = queryAllCompany(
    {
      ...baseParams,
      limit: 6,
      page: pageTypical,
      lang: router.locale as ELanguage,
      typical: 1,
    },
    GET_LIST_TYPICAL_COMPANY,
  );
  return (
    <div className='container'>
      <div className={style.company}>
        <Row>
          <Col span={24}>
            <Title level={3}>{t('typical_company')}</Title>
          </Col>
          <Col span={24}>
            <Paragraph
              className={style.text}
              style={{ display: 'flex', justifyContent: 'center', alignItems: 'center' }}
            >
              {t('desc_footer')}
            </Paragraph>
          </Col>
          <Col span={24} className={style.companyContent}>
            {Loading ? (
              <Spin />
            ) : (
              <Row gutter={[26, 32]} style={{ display: 'flex', justifyContent: 'center', alignItems: 'center' }}>
                {listTypicalCompany?.data &&
                  listTypicalCompany?.data.map((item) => <ListCompany listTypicalCompany={item} />)}
                {listTypicalCompany?.data && listTypicalCompany?.data.length === 0 && (
                  <Empty className='empty' description={t('no_data')} />
                )}
              </Row>
            )}
          </Col>
          <Col span={24} style={{ display: 'flex', justifyContent: 'center' }}>
            <Row>
              <Col>
                {listTypicalCompany?.data && listTypicalCompany?.data.length > 6 ? (
                  <Pagination defaultCurrent={1} onChange={(page) => setPageTypical(page)} total={50} />
                ) : (
                  ''
                )}
              </Col>
            </Row>
          </Col>
        </Row>
      </div>
    </div>
  );
}

export default Company;
