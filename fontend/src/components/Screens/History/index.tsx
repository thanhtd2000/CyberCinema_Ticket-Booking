import React from 'react';
import style from './style.module.less';
import { Breadcrumb, Col, Row } from 'antd';
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
                                                title: (
                                                      <a href='' style={{ color: 'white' }}>
                                                            Lịch sử giao dịch
                                                      </a>
                                                ),
                                          },
                                    ]}
                              />
                        </div>
                        <Col span={24} className={style.tableUser}>
                              <Row className={style.tableSize}>
                                    <Col span={24}>
                                          <Row className={style.titleTable}>
                                                <Col span={2}>
                                                      <p>Mã đơn</p>
                                                </Col>
                                                <Col span={5}>
                                                      <p>Phim</p>
                                                </Col>
                                                <Col span={3}>
                                                      <p>Phòng chiếu</p>
                                                </Col>
                                                <Col span={3}>
                                                      <p>Suất chiếu</p>
                                                </Col>
                                                <Col span={3}>
                                                      <p>Ghế đã đặt</p>
                                                </Col>
                                                <Col span={4}>
                                                      <p>Combo</p>
                                                </Col>
                                                <Col span={4}>
                                                      <p>Tổng tiền</p>
                                                </Col>
                                          </Row>
                                    </Col>
                                    <Col span={24}>
                                          <Row className={style.contentTable}>
                                                <Col span={2} className={style.th}>
                                                      M12
                                                </Col>
                                                <Col span={5} className={style.th}>
                                                      Transformer: Ngày khởi hoàn của anhvdfgdsfgdgfgsdfgsdfg 
                                                </Col>
                                                <Col span={3} className={style.th}>
                                                      B302
                                                </Col>
                                                <Col span={3} className={style.th}>
                                                      20:30 12-20-2023
                                                </Col>
                                                <Col span={3} className={style.th}>
                                                      G1,G2,G3,G4,G5,G6
                                                </Col>
                                                <Col span={4} className={style.th}>
                                                      FAMILY 202222222
                                                </Col>
                                                <Col span={4} className={style.th}>
                                                      200.000.000VNĐ
                                                </Col>
                                          </Row>
                                    </Col>
                                    <Col span={24}>
                                          <Row className={style.contentTable}>
                                                <Col span={2} className={style.th}>
                                                      M12
                                                </Col>
                                                <Col span={5} className={style.th}>
                                                      Transformer: Ngày khởi hoàn của anhvdfgdsfgdgfgsdfgsdfg 
                                                </Col>
                                                <Col span={3} className={style.th}>
                                                      B302
                                                </Col>
                                                <Col span={3} className={style.th}>
                                                      20:30 12-20-2023
                                                </Col>
                                                <Col span={3} className={style.th}>
                                                      G1,G2,G3,G4,G5,G6
                                                </Col>
                                                <Col span={4} className={style.th}>
                                                      FAMILY 202222222
                                                </Col>
                                                <Col span={4} className={style.th}>
                                                      200.000.000VNĐ
                                                </Col>
                                          </Row>
                                    </Col>
                              </Row>
                        </Col>
                  </div>
            </div>
      );
}

export default HistoryScreen;
