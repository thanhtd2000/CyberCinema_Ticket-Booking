/* eslint-disable react/jsx-no-undef */
import { useState, useEffect } from 'react';
import Link from 'next/link';
import Image from 'next/image';
import { Row, Col, Button, Drawer } from 'antd';
import { useRouter } from 'next/router';

import { handleChangeLanguage } from '@/libs/const';
import { ELanguage } from '@/configs/interface.config';

import style from './style.module.less';

function Header() {
      const router = useRouter();
      const [open, setOpen] = useState(false);
      const [navbar, setNavbar] = useState(false);
      const showDrawer = () => {
            setOpen(true);
      };
      function Tag() {
            return (
                  <Link className={style.logo2} href='/'>
                        <Image src='/images/Group 8 (2).png' height={48} width={186.43} alt='logo' />
                  </Link>
            );
      }
      const onClose = () => {
            setOpen(false);
      };
      useEffect(() => {
            const changeHeaderBackground = () => {
                  if (window.scrollY >= 50) {
                        setNavbar(true);
                  } else {
                        setNavbar(false);
                  }
            };
            window.addEventListener('scroll', changeHeaderBackground);
      });
      return (
            <div className={navbar ? `${style.header} ${style.active}` : `${style.header}`}>
                  <Row>
                        <Col span={24}>
                              <Row style={{ alignItems: 'center' }}>
                                    <Col span={16}>
                                          <Row gutter={[49, 0]}>
                                                <Col>
                                                      <Link className={style.logo1} href='/'>
                                                            <Image src='/images/Group 8.png' height={48} width={186.43} alt='logo' />
                                                      </Link>
                                                      <Link className={style.logo3} href='/'>
                                                            <Image src='/images/Group 8 (1).png' height={48} width={48} alt='logo' />
                                                      </Link>
                                                      <Link className={style.logo2} href='/'>
                                                            <Image src='/images/Group 8 (2).png' height={48} width={186.43} alt='logo' />
                                                      </Link>
                                                </Col>
                                                <Col className={style.navText}>
                                                      <ul className={style.nav}>
                                                            <Link href='/company'><li>Phim</li></Link>
                                                            <Link href='/post'>
                                                                  <li>Phim đang chiếu</li>
                                                            </Link>
                                                            <Link href='/news'>
                                                                  <li>Tin tức</li>
                                                            </Link>
                                                            <Link href='/'>
                                                                  <li>Liên hệ</li>
                                                            </Link>
                                                      </ul>
                                                </Col>
                                          </Row>
                                    </Col>
                                    <Col span={8}>
                                          <Row style={{ display: 'flex', justifyContent: 'flex-end' }} gutter={[16, 0]}>
                                                <Col span={18} className={style.button}>
                                                      <Row gutter={[12, 0]}>
                                                            <Col span={24}>
                                                                  <Button className={style.sigin}><Link href='login'>Đăng nhập / Đăng ký</Link></Button>
                                                            </Col>
                                                      </Row>
                                                </Col>
                                                <Col span={5} className={style.select}>
                                                      {router?.locale === ELanguage.VI ? (
                                                            <Button onClick={() => handleChangeLanguage(router)} className={style.selectLanguage}>
                                                                  <Image
                                                                        style={{ marginRight: '10px' }}
                                                                        src='/images/Frame (2).png'
                                                                        width={24}
                                                                        height={24}
                                                                        alt='en'
                                                                  />
                                                                  <span>EN</span>
                                                            </Button>
                                                      ) : (
                                                            <Button onClick={() => handleChangeLanguage(router)} className={style.selectLanguage}>
                                                                  <Image
                                                                        style={{ marginRight: '10px' }}
                                                                        src='/images/Frame (3).png'
                                                                        width={24}
                                                                        height={24}
                                                                        alt='en'
                                                                  />
                                                                  <span>VN</span>
                                                            </Button>
                                                      )}
                                                </Col>
                                                <Col className={style.menu}>
                                                      <Image onClick={showDrawer} src='/images/Frame (4).png' width={32} height={32} alt='logo' />
                                                      <Drawer title={<Tag />} placement='left' onClose={onClose} open={open}>
                                                            <Row>
                                                                  <Col span={24} className={style.drawerText}>
                                                                        <Link href='/company'>Phim</Link>
                                                                        <Link href='/post'>
                                                                              Phim đang chiếu
                                                                        </Link>
                                                                        <Link href='/'>
                                                                              Tin tức
                                                                        </Link>
                                                                        <Link href='/'>
                                                                              Liên hệ
                                                                        </Link>
                                                                  </Col>
                                                                  {router?.locale === ELanguage.VI ? (
                                                                        <Button onClick={() => handleChangeLanguage(router)} className={style.selectLanguage}>
                                                                              <Image
                                                                                    style={{ marginRight: '10px' }}
                                                                                    src='/images/Frame (2).png'
                                                                                    width={24}
                                                                                    height={24}
                                                                                    alt='en'
                                                                              />
                                                                              <span>EN</span>
                                                                        </Button>
                                                                  ) : (
                                                                        <Button onClick={() => handleChangeLanguage(router)} className={style.selectLanguage}>
                                                                              <Image
                                                                                    style={{ marginRight: '10px' }}
                                                                                    src='/images/Frame (3).png'
                                                                                    width={24}
                                                                                    height={24}
                                                                                    alt='en'
                                                                              />
                                                                              <span>VN</span>
                                                                        </Button>
                                                                  )}
                                                            </Row>
                                                      </Drawer>
                                                </Col>
                                          </Row>
                                    </Col>
                              </Row>
                        </Col>
                  </Row>
            </div>
      );
}

export default Header;
