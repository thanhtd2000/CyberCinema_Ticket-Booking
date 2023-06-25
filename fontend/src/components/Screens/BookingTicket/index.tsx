import React, { useEffect, useState } from 'react';
import style from './style.module.less';
import { Breadcrumb, Col, Row, Spin } from 'antd';
import Image from 'next/image';
import Link from 'next/link';
import { checkAuth, getLocalStored } from '@/libs/localStorage';
import { queryAllChair } from '@/queries/hooks/schedule';
import { useQueryPatchChair } from '@/queries/hooks/chair';
import LineChair from '@/components/Elements/LineChair/LineChair';
import dayjs from 'dayjs';

function BookingTicketScreen() {
      const [selectedBoxes, setSelectedBoxes] = useState([]);
      const values = getLocalStored('values');
      const movieDetail = getLocalStored('data');
      const valueRoom = getLocalStored('valueRoom');
      const [time, setTime] = useState()
      const [token, setToken] = useState<string>('');
      useEffect(() => {
            const accessTokenCurrent = checkAuth();
            setToken(accessTokenCurrent);
            window.addEventListener('storage', () => {
                  const accessToken = checkAuth();
                  setToken(accessToken);
            });
      }, []);
      // const {data : listChair} = useQueryPatchChair({id:idChair, schedule_id: valueRoom.schedule_id },token)
      const {mutate: updateChair, isLoading: loading, } = useQueryPatchChair()
      const handleBoxClick = (box: any) => {
            // console.log(data);
            // updateStatusChair(data, token);
            if(!loading){
                  updateChair({params:{id:box?.id, schedule_id: valueRoom.schedule_id }, token:token})
            }
            // setIdChair(box?.id)
            const isSelected = selectedBoxes.includes(box?.id);
            if (isSelected) {
                  const updatedBoxes = selectedBoxes.filter((selectedBox) => selectedBox !== box.id);
                  setSelectedBoxes(updatedBoxes);
            } else {
                  const updatedBoxes = [...selectedBoxes, box.id];
                  setSelectedBoxes(updatedBoxes);
            }
      };
      const { data: dataChair, isLoading } = queryAllChair(
            { id: valueRoom?.id, schedule_id: valueRoom?.schedule_id },
            token,
      );
      console.log(dataChair?.time?.start);
      const handleTime = () =>{
            const timeShow = +dayjs(dataChair?.time?.end).format('m') - +dayjs(dataChair?.time?.start).format('m')
            
      }
      useEffect(() => {
            const interval = setInterval(() => getTime(deadline), 1000);
        
            return () => clearInterval(interval);
          }, []);
      handleTime()
      return (
            <div className={`${style.bookingTicket} booking`} style={{ background: '#0D0E10' }}>
                  <div className='container'>
                        <div>
                              <Breadcrumb
                                    style={{ color: 'rgb(183, 177, 177)', paddingBottom: '30px', fontSize: '17px' }}
                                    items={[
                                          {
                                                title: (
                                                      <Link style={{ color: '#999' }} href='/'>
                                                            Home
                                                      </Link>
                                                ),
                                          },
                                          {
                                                title: (
                                                      <a href='' style={{ color: 'white' }}>
                                                            Booking Ticket
                                                      </a>
                                                ),
                                          },
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
                                          <Image src='/images/Screen (2).png' width={700} height={40} alt='empty chair' />
                                    </div>
                                    {!isLoading ? (
                                          <div className={style.chairs}>
                                                <LineChair dataChair={dataChair?.data?.A} handleBoxClick={handleBoxClick} selectedBoxes={selectedBoxes} ></LineChair>
                                                <LineChair dataChair={dataChair?.data?.B} handleBoxClick={handleBoxClick} selectedBoxes={selectedBoxes} ></LineChair>
                                                <LineChair dataChair={dataChair?.data?.C} handleBoxClick={handleBoxClick} selectedBoxes={selectedBoxes} ></LineChair>
                                                <LineChair dataChair={dataChair?.data?.D} handleBoxClick={handleBoxClick} selectedBoxes={selectedBoxes} ></LineChair>
                                                <LineChair dataChair={dataChair?.data?.E} handleBoxClick={handleBoxClick} selectedBoxes={selectedBoxes} ></LineChair>
                                                <LineChair dataChair={dataChair?.data?.F} handleBoxClick={handleBoxClick} selectedBoxes={selectedBoxes} ></LineChair>
                                                <LineChair dataChair={dataChair?.data?.G} handleBoxClick={handleBoxClick} selectedBoxes={selectedBoxes} ></LineChair>
                                                <LineChair dataChair={dataChair?.data?.H} handleBoxClick={handleBoxClick} selectedBoxes={selectedBoxes} ></LineChair>
                                                <LineChair dataChair={dataChair?.data?.I} handleBoxClick={handleBoxClick} selectedBoxes={selectedBoxes} ></LineChair>
                                                <LineChair dataChair={dataChair?.data?.J} handleBoxClick={handleBoxClick} selectedBoxes={selectedBoxes} ></LineChair>
                                          </div>
                                    ) : (
                                          <Spin></Spin>
                                    )}
                                    <Row className={style.TypeChair}>
                                          <Col span={8}>
                                                <div style={{ textAlign: 'center' }}>
                                                      <Image src='/images/NomarlChair.png' width={40} height={40} alt='empty chair' />
                                                </div>
                                                <p>Ghế Đơn</p>
                                          </Col>
                                          <Col span={8}>
                                                <div style={{ textAlign: 'center' }}>
                                                      <Image src='/images/chair/ChairVip.png' width={50} height={50} alt='Booking chair' />
                                                </div>
                                                <p>Ghế Vip</p>
                                          </Col>
                                          <Col span={8}>
                                                <div style={{ textAlign: 'center' }}>
                                                      <Image src='/images/chair/doubleChair.png' width={50} height={50} alt='Booking chair' />
                                                </div>
                                                <p>Ghế Đôi</p>
                                          </Col>
                                    </Row>
                              </Col>
                              <Col span={6} className={style.inforTicket}>
                                    <Image src={movieDetail?.image} alt='banner' width={150} height={300} />
                                    <Row style={{ paddingTop: '10px' }}>
                                          <Col>
                                                <span className={style.title}>Tên phim : </span>
                                          </Col>
                                          <Col>
                                                <p className={style.content}>{movieDetail?.name}</p>
                                          </Col>
                                    </Row>
                                    <Row style={{ paddingTop: '10px', justifyContent: 'space-between' }}>
                                          <Col>
                                                <span className={style.title}>Thời lượng : </span>
                                          </Col>
                                          <Col>
                                                <p className={style.content}>{movieDetail?.time}</p>
                                          </Col>
                                    </Row>
                                    <Row style={{ paddingTop: '10px', justifyContent: 'space-between' }}>
                                          <Col>
                                                <span className={style.title}>Phòng : </span>
                                          </Col>
                                          <Col>
                                                <p className={style.content}>{values?.room}</p>
                                          </Col>
                                    </Row>
                                    <Row style={{ paddingTop: '10px' }}>
                                          <Col>
                                                <span className={style.title}>Suất chiếu : </span>
                                          </Col>
                                          <Col>
                                                <p className={style.content}>
                                                      {values?.time} - ngày {values?.date}
                                                </p>
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
      );
}

export default BookingTicketScreen;
