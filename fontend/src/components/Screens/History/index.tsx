import React, { useMemo } from 'react'
import style from './style.module.less'
import { BsImageAlt } from 'react-icons/bs';
import { Breadcrumb, Button, Checkbox, Col, DatePicker, Form, Input, Radio, Row, Select, Upload } from 'antd'
import { USER_PROFILE } from '@/queries/keys';
import { checkAuth, getLocalStored } from '@/libs/localStorage';
import dayjs from 'dayjs';
import { UploadOutlined } from '@ant-design/icons';
import { useMutationUpdateUser } from '@/queries/hooks/user';
import Image from 'next/image';
import type { MenuProps } from 'antd';
import { Menu } from 'antd';
import Link from 'next/link';
type MenuItem = Required<MenuProps>['items'][number];
function getItem(
      label: React.ReactNode,
      key: React.Key,
      icon?: React.ReactNode,
      children?: MenuItem[],
      type?: 'group',
    ): MenuItem {
      return {
        key,
        icon,
        children,
        label,
        type,
      } as MenuItem;
    }
function HistoryScreen() {
      const token = checkAuth()
      const { mutate: updateUser } = useMutationUpdateUser()
      const items: MenuProps['items'] = [
            getItem(<Link href='/user'>Thông tin cá nhân</Link>, 'sub1'),
          
            getItem(<Link href='/user/history'>Lịch sử giao dịch</Link>, 'sub2'),
          
            getItem(<Link href='/user/transfer'>Trao đổi điểm</Link>, 'sub4'),
          ];
      const onFinish = (values: any) => {
            console.log('Success:', values);
            updateUser({ token, data: { ...values, image: values.image?.file } })
      };

      const onFinishFailed = (errorInfo: any) => {
            // console.log('Failed:', errorInfo);
      };
      const normFile = (e: any) => {
            if (Array.isArray(e)) {
                  return e;
            }
            return e?.fileList;
      };
      const onClick: MenuProps['onClick'] = (e) => {
            console.log('click ', e);
      };
      const user = getLocalStored(USER_PROFILE)
      const dateFormat = 'YYYY/MM/DD';
      // console.log(user);
      return (
            <div className={`${style.infor} inforUser`} style={{ background: '#0D0E10' }}>
                  <div className='container'>
                        <div>
                              <Breadcrumb
                                    style={{ color: 'rgb(183, 177, 177)', paddingBottom: '30px', fontSize: '17px' }}
                                    items={[
                                          {
                                                title: 'Home',
                                          },
                                          {
                                                title: <a href="" style={{ color: 'white' }}>Lịch sử giao dịch</a>,
                                          }
                                    ]}
                              />
                        </div>
                        <Row>
                              <Col span={5} style={{paddingRight: '25px'}}>
                                    <Menu
                                          onClick={onClick}
                                          style={{width: '230px'}}
                                          defaultSelectedKeys={['sub2']}
                                          items={items}
                                    />
                              </Col>
                              <Col span={19} style={{border: '1px solid orange'}}>
                                    <Row style={{borderBottom: '1px solid orange'}}>
                                          <Col span={4} className={style.tabHead}>
                                                <p>Mã đơn hàng</p>
                                          </Col>
                                          <Col span={4} className={style.tabHead} >
                                                <p>Phim</p>
                                          </Col>
                                          <Col span={4} className={style.tabHead}>
                                                <p>Ghế</p>
                                          </Col>
                                          <Col span={4} className={style.tabHead}>
                                                <p>Combo</p>
                                          </Col>
                                          <Col span={4} className={style.tabHead}>
                                                <p>Ngày đặt</p>
                                          </Col>
                                          <Col span={4} className={style.tabHead}>
                                                <p>Tổng tiền</p>
                                          </Col>
                                    </Row>
                              </Col>
                        </Row>
                  </div>
            </div>
      )
}

export default HistoryScreen