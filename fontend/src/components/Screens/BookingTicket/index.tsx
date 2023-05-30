import React from 'react'
import style from './style.module.less'
import { Breadcrumb, Col, Row } from 'antd'
import Image from 'next/image'
function BookingTicketScreen() {
      return (
            <div className={`${style.bookingTicket} booking`} style={{ background: '#0D0E10' }}>
                  <div className='container'>
                        <div>
                              <Breadcrumb
                                    style={{ color: 'rgb(183, 177, 177)', paddingBottom: '30px', fontSize: '17px' }}
                                    items={[
                                          {
                                                title: 'Home',
                                          },
                                          {
                                                title: <a href="" style={{ color: 'white' }}>Booking Ticket</a>,
                                          }
                                    ]}
                              />
                        </div>
                        <Row gutter={[50, 0]}>
                              <Col span={18} style={{ padding: '0 100px' }}>
                                    <div className={style.time}>
                                          <p>Thời gian giữ ghế</p>
                                          <span>04 : 58</span>
                                    </div>
                                    <div className={style.sreen}>
                                          <p></p>
                                    </div>
                                    <div className={style.chairs}>
                                          <Image src='/images/chair/emptyChair.png' width={50} height={50} alt='empty chair' />
                                          <Image src='/images/chair/BookingChair.png' width={50} height={50} alt='Booking chair' />
                                          <Image src='/images/chair/BookedChair.png' width={50} height={50} alt='Booked chair' />
                                          <Image src='/images/chair/VIPChair.png' width={50} height={50} alt='VIP chair' />
                                    </div>
                                    <Row className={style.TypeChair}>
                                          <Col span={6}>
                                                <div style={{ textAlign: 'center' }}>
                                                      <Image src='/images/chair/emptyChair.png' width={50} height={50} alt='empty chair' />
                                                </div>
                                                <p>Ghế Trống</p>
                                          </Col>
                                          <Col span={6}>
                                                <div style={{ textAlign: 'center' }}>
                                                      <Image src='/images/chair/BookingChair.png' width={50} height={50} alt='Booking chair' />
                                                </div>
                                                <p>Ghế Đang Chọn</p>
                                          </Col>
                                          <Col span={6}>
                                                <div style={{ textAlign: 'center' }}>
                                                      <Image src='/images/chair/BookedChair.png' width={50} height={50} alt='Booked chair' />

                                                </div>
                                                <p>Ghế Đã Chọn</p>
                                          </Col>
                                          <Col span={6}>
                                                <div style={{ textAlign: 'center' }}>
                                                      <Image src='/images/chair/VIPChair.png' width={50} height={50} alt='VIP chair' />

                                                </div>
                                                <p>Ghế VIP</p>
                                          </Col>
                                    </Row>
                              </Col>
                              <Col span={6} className={style.inforTicket}>
                                    <Image src='/images/movies/5f1fefa094f6bfe1ae1b5f80a2f65a7c.jpg' alt='banner' width={150} height={300} />
                                    <Row style={{ paddingTop: '10px' }}>
                                          <Col>
                                                <span className={style.title}>Tên phim : </span>

                                          </Col>
                                          <Col>
                                                <p className={style.content}>Transformers: Rise of the Beasts | Official Trailer (2023 Movie)</p>

                                          </Col>
                                    </Row>
                                    <Row style={{ paddingTop: '10px', justifyContent: 'space-between' }}>
                                          <Col>
                                                <span className={style.title}>Thời lượng : </span>

                                          </Col>
                                          <Col>
                                                <p className={style.content}>110 phút</p>

                                          </Col>
                                    </Row>
                                    <Row style={{ paddingTop: '10px', justifyContent: 'space-between' }}>
                                          <Col>
                                                <span className={style.title}>Phòng : </span>

                                          </Col>
                                          <Col>
                                                <p className={style.content}>Rạp 5</p>

                                          </Col>
                                    </Row>
                                    <Row style={{ paddingTop: '10px' }}>
                                          <Col>
                                                <span className={style.title}>Suất chiếu : </span>

                                          </Col>
                                          <Col>
                                                <p className={style.content}>10 : 00 ngày 21/01/2000</p>

                                          </Col>
                                    </Row>
                                    <Row style={{ paddingTop: '10px', justifyContent: 'space-between' }}>
                                          <Col>
                                                <span className={style.title}>Ghế : </span>

                                          </Col>
                                          <Col>
                                                <p className={style.content}>L2</p>

                                          </Col>
                                    </Row>
                                    <Row style={{ paddingTop: '10px', justifyContent: 'space-between' }}>
                                          <Col>
                                                <span className={style.title}>Giá : </span>

                                          </Col>
                                          <Col>
                                                <p className={style.content}>200.000 đ</p>

                                          </Col>
                                    </Row>
                              </Col>
                        </Row>
                  </div>
            </div>
      )
}

export default BookingTicketScreen