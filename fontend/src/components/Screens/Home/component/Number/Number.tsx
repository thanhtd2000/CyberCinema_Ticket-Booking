import React from 'react';
import { Row, Col, Typography } from 'antd';
import { useTranslation } from 'next-i18next';
import Image from 'next/image';

import style from './style.module.less';

const { Title, Paragraph } = Typography;

function Number() {
  const { t } = useTranslation();
  return (
    <div className='container'>
      <div className={style.number}>
        <div className={style.background}>
          <div className={style.content}>
            <Row style={{ textAlign: 'center' }}>
              <Col span={24}>
                <Paragraph className={style.text}>{t('improve_enterprise')}</Paragraph>
              </Col>
              <Col span={24}>
                <Title level={3} className={style.title}>
                  {t('number_suprise')}
                </Title>
              </Col>
              <Col span={24}>
                <Row gutter={[48, 0]}>
                  <Col xs={12} sm={12} md={12} lg={12} xl={6}>
                    <div className={style.line}>
                      <Image src='/images/Frame (8).png' width={16} height={16} alt='logo' />
                    </div>
                    <Title level={3}>1 {t('milion')}+</Title>
                    <Paragraph className={style.paragraph}>{t('acuracy')}</Paragraph>
                  </Col>
                  <Col xs={12} sm={12} md={12} lg={12} xl={6}>
                    <div className={style.line}>
                      <Image src='/images/Frame (9).png' width={16} height={16} alt='logo' />
                    </div>
                    <Title level={3}>50k+</Title>
                    <Paragraph className={style.paragraph}>{t('account')}</Paragraph>
                  </Col>
                  <Col xs={12} sm={12} md={12} lg={12} xl={6}>
                    <div className={style.line}>
                      <Image src='/images/Frame (10).png' width={16} height={16} alt='logo' />
                    </div>
                    <Title level={3}>800%</Title>
                    <Paragraph className={style.paragraph}>{t('growth')}</Paragraph>
                  </Col>
                  <Col xs={12} sm={12} md={12} lg={12} xl={6}>
                    <div className={style.line}>
                      <Image src='/images/Frame (11).png' width={16} height={16} alt='logo' />
                    </div>
                    <Title level={3}>100%</Title>
                    <Paragraph className={style.paragraph}>{t('probability')}</Paragraph>
                  </Col>
                </Row>
              </Col>
            </Row>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Number;
