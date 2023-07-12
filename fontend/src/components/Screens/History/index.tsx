import React from 'react'
import style from './style.module.less'
import { Breadcrumb,Col,Row} from 'antd'
import type { MenuProps } from 'antd';
type MenuItem = Required<MenuProps>['items'][number];
function HistoryScreen() {
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
                        <div style={{overflowX: 'auto'}}>
                              <Row gutter={[0, 24]} style={{width: '100%'}}>
                                    <Col span={24} style={{ border: '1px solid orange' }}>
                                          <Row>
                                                <Col span={3} className={style.tabHead}>
                                                      <p>Mã đơn hàng</p>
                                                </Col>
                                                <Col span={5} className={style.tabHead} >
                                                      <p>Phim</p>
                                                </Col>
                                                <Col span={3} className={style.tabHead}>
                                                      <p>Ghế</p>
                                                </Col>
                                                <Col span={6} className={style.tabHead}>
                                                      <p>Combo</p>
                                                </Col>
                                                <Col span={4} className={style.tabHead}>
                                                      <p>Ngày đặt</p>
                                                </Col>
                                                <Col span={3} className={style.tabHead}>
                                                      <p>Tổng tiền</p>
                                                </Col>
                                          </Row>
                                    </Col>
                                    <Col span={24}>
                                          <Row style={{ border: '1px solid orange' }}>
                                                <Col span={3}>
                                                      <p>Mã đơn hàng</p>
                                                </Col>
                                                <Col span={5} >
                                                      <p>Phim</p>
                                                </Col>
                                                <Col span={3}>
                                                      <p>Ghế</p>
                                                </Col>
                                                <Col span={6}>
                                                      <p>Combo</p>
                                                </Col>
                                                <Col span={4}>
                                                      <p>Ngày đặt</p>
                                                </Col>
                                                <Col span={3}>
                                                      <p>Tổng tiền</p>
                                                </Col>
                                          </Row>
                                    </Col>
                              </Row>
                        </div>
                  </div>
            </div>
      )
}

export default HistoryScreen