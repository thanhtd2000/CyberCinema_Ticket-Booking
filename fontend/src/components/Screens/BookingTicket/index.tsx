import React, { useEffect, useState } from 'react'
import style from './style.module.less'
import { Breadcrumb, Col, Row } from 'antd'
import Image from 'next/image'
import { useQueryClient } from 'react-query';
import Link from 'next/link';
import { checkAuth } from '@/libs/localStorage';
import { queryAllChair, useMutationGetRoom } from '@/queries/hooks/schedule';
import { useGlobalState } from '@/libs/GlobalStateContext';
function BookingTicketScreen() {

      const [chair, setChair] = useState()
      const queryClient = useQueryClient();
      const stateData = queryClient.getQueryData('myState');
      const data = queryClient.getQueryData('data');
      const [token, setToken] = useState<string>('');
      const { globalState } = useGlobalState();
      console.log(globalState);
      useEffect(() => {
            const accessTokenCurrent = checkAuth();
            setToken(accessTokenCurrent);
            window.addEventListener('storage', () => {
                  const accessToken = checkAuth();
                  setToken(accessToken);
            });
      }, []);
      // const body = {id:globalState?.id, schedule_id:globalState?.schedule_id}
      const { data: dataChair } = queryAllChair({ id: globalState?.id, schedule_id: globalState?.schedule_id }, token)
      console.log(dataChair);
      // const { mutate: getRoom } = useMutationGetRoom();
      // useEffect(() => {
      //       const formData = new FormData()
      //       formData.append('id', globalState?.id)
      //       formData.append('schedule_id', globalState?.schedule_id)
      //       getRoom({ body: formData, token }, {
      //             onSuccess: (res) => {
      //                   console.log(res.data);
      //             },
      //       })
      // }, [])
      return (
            <div className={`${style.bookingTicket} booking`} style={{ background: '#0D0E10' }}>
                  <div className='container'>
                        <div>
                              <Breadcrumb
                                    style={{ color: 'rgb(183, 177, 177)', paddingBottom: '30px', fontSize: '17px' }}
                                    items={[
                                          {
                                                title: <Link style={{ color: '#999' }} href='/'>Home</Link>,
                                          },
                                          {
                                                title: <a href="" style={{ color: 'white' }}>Booking Ticket</a>,
                                          }
                                    ]}
                              />
                        </div>
                        {
                              data ? (<Row gutter={[50, 0]}>
                                    <Col span={18} style={{ padding: '0 100px' }}>
                                          <div className={style.time}>
                                                <p>Thời gian giữ ghế</p>
                                                <span>04 : 58</span>
                                          </div>
                                          <div className={style.sreen}>
                                                <Image src='/images/Screen (2).png' width={700} height={40} alt='empty chair' />
                                          </div>
                                          <div className={style.chairs}>
                                                <Row gutter={[24, 15]}>
                                                      {
                                                            dataChair && dataChair.map((item) => {
                                                                  if (item.type.name === 'Đơn') {
                                                                        return (<Col>
                                                                              <Image src='/images/NomarlChair.png' width={40} height={40} alt='empty chair' />
                                                                        </Col>)
                                                                  }
                                                                  else if(item.type.name=== 'Vip'){
                                                                        return (<Col>
                                                                             <Image src='/images/chair/ChairVip.png' width={50} height={50} alt='Booking chair' />
                                                                        </Col>)
                                                                  }
                                                            })
                                                      }
                                                </Row>
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
                                          <Image src={data?.image} alt='banner' width={150} height={300} />
                                          <Row style={{ paddingTop: '10px' }}>
                                                <Col>
                                                      <span className={style.title}>Tên phim : </span>

                                                </Col>
                                                <Col>
                                                      <p className={style.content}>{data?.name}</p>

                                                </Col>
                                          </Row>
                                          <Row style={{ paddingTop: '10px', justifyContent: 'space-between' }}>
                                                <Col>
                                                      <span className={style.title}>Thời lượng : </span>

                                                </Col>
                                                <Col>
                                                      <p className={style.content}>{data?.time}</p>

                                                </Col>
                                          </Row>
                                          <Row style={{ paddingTop: '10px', justifyContent: 'space-between' }}>
                                                <Col>
                                                      <span className={style.title}>Phòng : </span>

                                                </Col>
                                                <Col>
                                                      <p className={style.content}>{stateData?.room}</p>

                                                </Col>
                                          </Row>
                                          <Row style={{ paddingTop: '10px' }}>
                                                <Col>
                                                      <span className={style.title}>Suất chiếu : </span>

                                                </Col>
                                                <Col>
                                                      <p className={style.content}>{stateData?.time} - ngày {stateData?.date}</p>

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
                              </Row>) : <Link href='/movies' >Vui lòng chọn phim</Link>
                        }
                  </div>
            </div>
      )
}

export default BookingTicketScreen