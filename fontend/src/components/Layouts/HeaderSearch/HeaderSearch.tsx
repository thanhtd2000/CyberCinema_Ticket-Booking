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
import { queryAllMoviesBySearch } from '@/queries/hooks/movies';

import { TQueryMovies } from '@/modules/movies';
import { baseParams } from '@/configs/const.config';

const { Search } = Input;

function HeaderSearch() {
      const [params, setParams] = useState<TQueryMovies>();
      const router = useRouter();
      const [open, setOpen] = useState(false);
      let navbar;
      const showDrawer = () => {
            setOpen(true);
      };
      const onClose = () => {
            setOpen(false);
      };
      const onSearch = (value: string) => {
            setParams({...params, s: value})
      };
      const {
            data: movies
      } = queryAllMoviesBySearch({...baseParams,...params, isHot: 0});
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
                                                            Phim đang chiếu
                                                      </Link>
                                                      <Link href='/post' className={style.nav}>
                                                            Tin tức
                                                      </Link>
                                                      <Link href='/' className={style.nav}>
                                                            Liên hệ
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
                                                                              <Image src='/images/logoCyberMovies.png' style={{ objectFit: 'contain' }} height={70} width={70} alt='logo' />
                                                                        </Link>
                                                                        <Link className={style.logo3} href='/'>
                                                                              <Image src='/images/logoCyberMobie.png' style={{ objectFit: 'contain' }} height={48} width={48} alt='logo' />
                                                                        </Link>
                                                                  </Col>
                                                                  <Col span={14} style={{ display: 'flex', alignItems: 'center' }}>
                                                                        <Search className={style.search} onSearch={onSearch} placeholder='Nhập tên phim' enterButton />
                                                                  </Col>
                                                            </Row>
                                                      </Col>
                                                      <Col span={8}>
                                                            <Row style={{ display: 'flex', justifyContent: 'flex-end' }} gutter={[16, 0]}>
                                                                  <Col className={style.button}>
                                                                        <Row gutter={[12, 0]}>
                                                                              <Col span={12}>
                                                                                    <Button className={style.sigin}><Link href='/login'>Login</Link></Button>
                                                                              </Col>
                                                                              <Col span={12}>
                                                                                    <Button className={style.sigup}>
                                                                                          <span>
                                                                                                <span style={{ background: 'transparent', marginRight: '8px' }}>
                                                                                                      <ImUserPlus />
                                                                                                </span>
                                                                                                Register
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
                                                                                                allowClear
                                                                                                className={style.searchMenu}
                                                                                                placeholder='Nhập tên phim'
                                                                                                enterButton
                                                                                          />
                                                                                    </Col>
                                                                                    <Col span={24} className={style.drawerText}>
                                                                                          <Link href='/' style={{ display: 'block', color: '#595959', padding: '10px 0' }}>
                                                                                                Phimm
                                                                                          </Link>
                                                                                          <Link href='/' style={{ display: 'block', color: '#595959', padding: '10px 0' }}>
                                                                                                Tin tức
                                                                                          </Link>
                                                                                          <Link href='/' style={{ display: 'block', color: '#595959', padding: '10px 0' }}>
                                                                                                Liên hệ
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
