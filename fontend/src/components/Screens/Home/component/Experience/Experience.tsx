import React from 'react';
import { Row, Col, Typography, Button } from 'antd';
import { useTranslation } from 'next-i18next';

import style from './style.module.less';

const { Title, Paragraph } = Typography;
function Experience() {
  const { t } = useTranslation();
  return (
    <div className='container'>
      <div className={style.experience}>
        <div className={style.banner}>
          <Row className={style.expContent}>
            <Col sm={11} md={11} lg={8}>
              <Row>
                <Col span={24}>
                  <Paragraph className={style.paragraph}>{t('fast_search')}</Paragraph>
                </Col>
                <Col span={24}>
                  <Title level={3}>{t('opportunity')}</Title>
                </Col>
                <Col span={24}>
                  <Button>{t('register')}</Button>
                </Col>
              </Row>
            </Col>
          </Row>
        </div>
        <div className={style.bannerMobie}>
          <Row className={style.expContent}>
            <Col sm={24}>
              <Row>
                <Col span={24}>
                  <Paragraph className={style.paragraph}>{t('fast_search')}</Paragraph>
                </Col>
                <Col span={24}>
                  <Title level={3}>{t('opportunity')}</Title>
                </Col>
                <Col span={24}>
                  <Button>{t('register')}</Button>
                </Col>
              </Row>
            </Col>
          </Row>
        </div>
      </div>
    </div>
  );
}

export default Experience;
