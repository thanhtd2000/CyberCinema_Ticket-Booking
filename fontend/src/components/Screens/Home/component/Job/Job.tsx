import React, { useState } from 'react';
import { Row, Col, Typography, Button, Pagination, Spin } from 'antd';
import { useRouter } from 'next/router';
import { useTranslation } from 'next-i18next';

import ListJobs from '@/components/Elements/ListJobs/ListJobs';
import { baseParams } from '@/configs/const.config';
import { ELanguage } from '@/configs/interface.config';
import { queryAllCategory } from '@/queries/hooks/categories';

import style from './style.module.less';

const { Title } = Typography;
function Job() {
  const { t } = useTranslation();
  const [pageCategory, setPageCategory] = useState(1);
  const router = useRouter();
  const { data: listAllCategory } = queryAllCategory({
    ...baseParams,
    page: pageCategory,
    limit: 12,
    lang: router.locale as ELanguage,
  });
  return (
    <div className='container'>
      <div className={style.jobs}>
        <Row>
          <Col span={24} className={style.title}>
            <Title level={4}>{t('category_jobs')}</Title>
            <Button>{t('view_all')}</Button>
          </Col>
          <Col span={24}>
            <Row gutter={[24, 24]} style={{ justifyContent: 'center', alignItems: 'center' }}>
              {listAllCategory?.data && listAllCategory.data ? (
                listAllCategory.data.map((item) => <ListJobs listAllCategory={item} />)
              ) : (
                <Spin />
              )}
            </Row>
          </Col>
          <Col span={24} style={{ display: 'flex', justifyContent: 'center', paddingTop: '48px' }}>
            <Row>
              <Col>
                <Pagination
                  onChange={(page) => setPageCategory(page)}
                  current={pageCategory || 1}
                  hideOnSinglePage
                  showSizeChanger={false}
                  defaultCurrent={1}
                  total={Math.ceil(((listAllCategory?.total || 0) * 10) / 9)}
                />
              </Col>
            </Row>
          </Col>
        </Row>
      </div>
    </div>
  );
}

export default Job;
