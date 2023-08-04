/* eslint-disable react/jsx-no-undef */
import React, { useState, useEffect } from 'react';
import Link from 'next/link';
import Image from 'next/image';
import { Row, Col, Button, Drawer, Dropdown, Space, MenuProps, Spin } from 'antd';
import { useRouter } from 'next/router';
import { IoDiamondOutline, IoLogOutOutline } from 'react-icons/io5';
import { TbArrowsExchange2 } from 'react-icons/tb';
import { handleChangeLanguage } from '@/libs/const';
import { ELanguage } from '@/configs/interface.config';

import style from './style.module.less';
import { useMutationSignOut } from '@/queries/hooks';
import { checkAuth } from '@/libs/localStorage';
import { UserOutlined } from '@ant-design/icons';
import { queryGetProfile } from '@/queries/hooks/user';

function Header() {
      const router = useRouter();
      const [open, setOpen] = useState(false);
      const [navbar, setNavbar] = useState(false);
      const [token, setToken] = useState(undefined);
      useEffect(() => {
            if (checkAuth()) {
                  setToken(checkAuth() as any)
            }
      }, [checkAuth()])

      const showDrawer = () => {
            setOpen(true);
      };
      const { data: user, isLoading, isFetching } = queryGetProfile(token)
      const { mutate: signOut, isError } = useMutationSignOut();
      // useEffect(()=>{
      //       signOut()
      // },[isError])
      console.log(isError);
      const handleLogout = () => {
            signOut()
            setToken(undefined)
      }
      function Tag() {
            return (
                  <Link className={style.logo2} href='/'>
                        <Image src='/images/logoMovieBackgroundWhite.png' height={70} width={70} alt='logo' />
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
      const items: MenuProps['items'] = [
            {
                  key: '1',
                  icon: <UserOutlined />,
                  label: (
                        <Link href='/user'>Thông tin tài khoản</Link>
                  ),
            },
            {
                  key: '2',
                  icon: <IoDiamondOutline />,
                  label: (
                        <Link href='/user/history'>Lịch sử đặt vé</Link>
                  ),
            },
            {
                  key: '3',
                  icon: <TbArrowsExchange2 />,
                  label: (
                        <Link href='/user'>Thay đổi mật khẩu</Link>
                  ),
            },
            {
                  key: '3',
                  icon: <IoLogOutOutline />,
                  label: (
                        <Link onClick={() => handleLogout()} href='/'>Đăng xuất</Link>
                  ),
            },
      ];
      return (
            <div className={navbar ? `${style.header} ${style.active}` : `${style.header}`}>
                  <Row>
                        <Col span={24}>
                              <Row style={{ alignItems: 'center' }}>
                                    <Col span={16}>
                                          <Row gutter={[49, 0]}>
                                                <Col>
                                                      <Link className={style.logo1} href='/'>
                                                            <Image src='/images/logoCyberMovies.png' height={70} width={130} alt='logo' />
                                                      </Link>
                                                      <Link className={style.logo3} href='/'>
                                                            <Image src='/images/logoCyberMobie.png' height={48} width={48} alt='logo' />
                                                      </Link>
                                                      <Link className={style.logo2} href='/'>
                                                            <Image src='/images/logoCyberMovies.png' height={70} width={130} alt='logo' />
                                                      </Link>
                                                </Col>
                                                <Col className={style.navText}>
                                                      <ul className={style.nav}>
                                                            <Link href='/movies'><li>Phim</li></Link>
                                                            <Link href='/news'>
                                                                  <li>Tin tức</li>
                                                            </Link>
                                                            <Link href='/contact'>
                                                                  <li>Liên hệ</li>
                                                            </Link>
                                                      </ul>
                                                </Col>
                                          </Row>
                                    </Col>
                                    <Col span={8}>
                                          <Row style={{ display: 'flex', justifyContent: 'flex-end' }} gutter={[16, 0]}>
                                                <Col span={17} className={style.button}>
                                                      <Row gutter={[12, 0]}>
                                                            {
                                                                  isLoading && isFetching ? <Spin /> :
                                                                        <Col span={24}>
                                                                              {
                                                                                    user && !!token ? (<Dropdown menu={{ items }}>
                                                                                          <a onClick={(e) => e.preventDefault()}>
                                                                                                {
                                                                                                      user && (<Space className={style.userHeader}>
                                                                                                            {user?.name}
                                                                                                      </Space>)
                                                                                                }
                                                                                          </a>
                                                                                    </Dropdown>) : (<Button className={style.sigin}><Link href='/login'>Đăng nhập / Đăng ký</Link></Button>)



                                                                              }
                                                                        </Col>
                                                            }

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
                                                                        <Link href='/movies'>Phim</Link>
                                                                        <Link href='/'>
                                                                              Tin tức
                                                                        </Link>
                                                                        <Link href='/contact'>
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