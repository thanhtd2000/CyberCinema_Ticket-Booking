/* eslint-disable react/no-unstable-nested-components */
import React, { useState } from 'react';
import { Row, Col, Input, Button, Drawer } from 'antd';
import { ImUserPlus } from 'react-icons/im';
import Link from 'next/link';
import Image from 'next/image';
import { useTranslation } from 'next-i18next';
import { useRouter } from 'next/router';

import { handleChangeLanguage } from '@/libs/const';
import { ELanguage } from '@/configs/interface.config';

import style from './style.module.less';

const { Search } = Input;

function HeaderSearch() {
  const { t } = useTranslation();
  const router = useRouter();
  const [open, setOpen] = useState(false);
  let navbar;
  const showDrawer = () => {
    setOpen(true);
  };
  const onClose = () => {
    setOpen(false);
  };
  // eslint-disable-next-line react/no-unstable-nested-components
  function Tag() {
    return (
      <Link className={style.logo2} href='/'>
        <Image src='/images/Group 8 (2).png' height={48} width={186.43} alt='logo' />
      </Link>
    );
  }
  function EN() {
    return (
      <Button onClick={() => handleChangeLanguage(router)} className={style.selectLanguage}>
        <Image style={{ marginRight: '10px' }} src='/images/Frame (2).png' width={24} height={24} alt='en' />
        <span>EN</span>
      </Button>
    );
  }
  function VN() {
    return (
      <Button onClick={() => handleChangeLanguage(router)} className={style.selectLanguage}>
        <Image style={{ marginRight: '10px' }} src='/images/Frame (3).png' width={24} height={24} alt='en' />
        <span>VN</span>
      </Button>
    );
  }
  return (
    <div className={style.headerSearch}>
      <Row>
        <Col span={24}>
          <Row className={style.headerTop}>
            <Col span={24}>
              <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between' }}>
                <ul>
                  <Link href='/' className={style.nav}>
                    {t('find_company')}
                  </Link>
                  <Link href='/post' className={style.nav}>
                    {t('news')}
                  </Link>
                  <Link href='/' className={style.nav}>
                    {t('contact')}
                  </Link>
                </ul>
                {router?.locale === ELanguage.VI ? <EN /> : <VN />}
              </div>
            </Col>
          </Row>
        </Col>
        <Col span={24}>
          <div className={navbar ? `${style.header} ${style.active}` : `${style.header}`}>
            <Row>
              <Col span={24}>
                <Row style={{ alignItems: 'center', justifyContent: 'space-between' }}>
                  <Col span={16}>
                    <Row gutter={[49, 0]}>
                      <Col>
                        <Link className={style.logo1} href='/'>
                          <Image src='/images/Group 8 (2).png' height={48} width={186.43} alt='logo' />
                        </Link>
                        <Link className={style.logo3} href='/'>
                          <Image src='/images/Group 8 (1).png' height={48} width={48} alt='logo' />
                        </Link>
                      </Col>
                      <Col span={14} style={{ display: 'flex', alignItems: 'center' }}>
                        <Search className={style.search} placeholder={t('home:placeholder_search')} enterButton />
                      </Col>
                    </Row>
                  </Col>
                  <Col span={8}>
                    <Row style={{ display: 'flex', justifyContent: 'flex-end' }} gutter={[16, 0]}>
                      <Col className={style.button}>
                        <Row gutter={[12, 0]}>
                          <Col span={12}>
                            <Button className={style.sigin}>{t('sign_in')}</Button>
                          </Col>
                          <Col span={12}>
                            <Button className={style.sigup}>
                              <span>
                                <span style={{ background: 'transparent', marginRight: '8px' }}>
                                  <ImUserPlus />
                                </span>
                                {t('sign_up')}
                              </span>
                            </Button>
                          </Col>
                        </Row>
                      </Col>
                      <Col className={style.menu}>
                        <Image onClick={showDrawer} src='/images/Frame (4).png' width={32} height={32} alt='logo' />
                        <Drawer title={<Tag />} placement='left' onClose={onClose} open={open}>
                          <Row className={style.drawerContent}>
                            <Col span={24}>
                              <Search
                                className={style.searchMenu}
                                placeholder={t('home:placeholder_search')}
                                enterButton
                              />
                            </Col>
                            <Col span={24} className={style.drawerText}>
                              <Link href='/' style={{ display: 'block', color: '#595959', padding: '10px 0' }}>
                                {t('find_company')}
                              </Link>
                              <Link href='/' style={{ display: 'block', color: '#595959', padding: '10px 0' }}>
                                {t('news')}
                              </Link>
                              <Link href='/' style={{ display: 'block', color: '#595959', padding: '10px 0' }}>
                                {t('contact')}
                              </Link>
                            </Col>
                            <Col span={24}>{router?.locale === ELanguage.VI ? <EN /> : <VN />}</Col>
                          </Row>
                        </Drawer>
                      </Col>
                    </Row>
                  </Col>
                </Row>
              </Col>
            </Row>
          </div>
        </Col>
      </Row>
    </div>
  );
}

export default HeaderSearch;
