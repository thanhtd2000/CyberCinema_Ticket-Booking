import React from 'react';
import style from './style.module.less';
import { Breadcrumb, Col, Empty, Row, Spin } from 'antd';
import { checkAuth } from '@/libs/localStorage';
import { queryHistory } from '@/queries/hooks/payment';
import Link from 'antd/es/typography/Link';
function HistoryScreen() {
  const token = checkAuth();
  const { data: history, isLoading } = queryHistory(token);
  console.log(history);
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
                <Col span={2}>
                  <p>Số point</p>
                </Col>
                <Col span={2}>
                  <p>Chi tiết</p>
                </Col>
              </Row>
            </Col>
            {history && history ? (
              <Col span={24}>
                {!isLoading ? (
                  history?.map((item: any) => (
                    <Row className={style.contentTable}>
                      <Col span={2} className={style.th}>
                        {item?.id}
                      </Col>
                      <Col span={5} className={style.th}>
                        {item?.movie_name}
                      </Col>
                      <Col span={3} className={style.th}>
                        {item?.room_name}
                      </Col>
                      <Col span={3} className={style.th}>
                        {item?.time_start}
                      </Col>
                      <Col span={3} className={style.th}>
                        {item?.seat_name?.map((i: any) => (
                          <span>{i} </span>
                        ))}
                      </Col>
                      <Col span={4} className={style.th}>
                        {item?.product_name.length > 0 ? item?.product_name?.map((item: any) => <p>{item}</p>) : '--'}
                      </Col>
                      <Col span={2} className={style.th}>
                        {item?.addPoints ? <div>{item?.addPoints} point</div> : '--'}
                      </Col>
                      <Col span={2} className={style.th}>
                        {(() => {
                          if (item?.status === 1) {
                            return <p style={{ color: 'green' }}>Đang thanh toán</p>;
                          } else if (item?.status === 2) {
                            return (
                              <Link href={item?.link} style={{ color: 'orange' }}>
                                Chi tiết
                              </Link>
                            );
                          } else {
                            return <p style={{ color: 'red' }}>Đã huỷ</p>;
                          }
                        })()}
                      </Col>
                    </Row>
                  ))
                ) : (
                  <div style={{ display: 'flex', justifyContent: 'center', width: '100%', padding: '50px 0' }}>
                    <Spin style={{ color: 'orange' }}></Spin>
                  </div>
                )}
              </Col>
            ) : (
              <div style={{ display: 'flex', justifyContent: 'center', width: '100%', padding: '50px 0' }}>
                <Empty description={false} />
              </div>
            )}
          </Row>
        </Col>
      </div>
    </div>
  );
}

export default HistoryScreen;
