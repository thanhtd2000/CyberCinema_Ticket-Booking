import React, { useEffect, useMemo, useState } from 'react';
import style from './style.module.less';
import { Breadcrumb, Button, Col, Row, Spin } from 'antd';
import Image from 'next/image';
import Link from 'next/link';
import { checkAuth, clearLocalStored, getLocalStored } from '@/libs/localStorage';
import { queryAllChair } from '@/queries/hooks/schedule';
import { useQueryPatchChair } from '@/queries/hooks/chair';
import LineChair from '@/components/Elements/LineChair/LineChair';;
import OrderTicket from './Order';
import { useGlobalState } from '@/libs/GlobalStateContext';
import CountTime from '@/components/Elements/Timer/Timer';
import { useTranslation } from 'react-i18next';

function BookingTicketScreen() {
      const { t } = useTranslation();
      const [selectedBoxes, setSelectedBoxes] = useState<any>([]);
      const values = getLocalStored('values');
      const movieDetail = getLocalStored('data');
      const valueRoom = getLocalStored('valueRoom');
      const [token, setToken] = useState<string>('');
      const [component, setComponent] = useState(1)
      const { globalState } = useGlobalState();
      useEffect(() => {
            const accessTokenCurrent = checkAuth();
            setToken(accessTokenCurrent);
            window.addEventListener('storage', () => {
                  const accessToken = checkAuth();
                  setToken(accessToken);
            });
      }, []);
      useEffect(()=>{
            if(globalState){
                  clearLocalStored('valueRoom')
            }
      },[globalState])
      
      const { mutate: updateChair, isLoading: loading, isError } = useQueryPatchChair()
      const handleBoxClick = (box: any | never) => {
            if (!loading) {
                  updateChair({ params: { id: box?.id, schedule_id: valueRoom.schedule_id, total : movieDetail?.price + box?.price }, token: token })
            }
            const isSelected = selectedBoxes.includes(box);
            if (isSelected) {
                  const updatedBoxes = selectedBoxes.filter((selectedBox: any) => selectedBox !== box);
                  if(selectedBoxes.length<5){
                        setSelectedBoxes(updatedBoxes);
                  }
            } else {
                  const updatedBoxes = [...selectedBoxes, box];
                  if(selectedBoxes.length<5){
                        setSelectedBoxes(updatedBoxes);
                  }
            }
      };
      const { data: dataChair, isLoading, refetch, isFetching } = queryAllChair(
            { id: valueRoom?.id, schedule_id: valueRoom?.schedule_id },
            token,
            );
      const totalPrice = useMemo(() => selectedBoxes.length > 0 ? selectedBoxes.reduce((amount: number, current: any) => amount + current.price , 0) : null, [selectedBoxes])
      return (
            <div className={`${style.bookingTicket} booking Loading`} style={{ background: '#0D0E10' }}>
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
                        <Row>
                              {
                                    component && component === 1 ? (<Col xs={24} sm={24} md={24} lg={18} className={style.bookChair}>
                                          {
                                                selectedBoxes.length > 0 ? (<div className={style.warning}>
                                                      <p>{t('movies:regulations')} {movieDetail?.year_old} {t('movies:old')}.</p>
                                                </div>) : ''
                                          }
                                          <div className={style.time}>
                                                <p>{t('movies:TimeKeep')}</p>
                                                {dataChair?.time  && dataChair?.time ? (<CountTime expiresAt={dataChair?.time} />) : (<Spin></Spin>)}
                                          </div>
                                          <Row className={style.TypeChairSelect}>
                                                <Col span={6}>
                                                      <div style={{ textAlign: 'center' }}>
                                                            <Image src='/images/NomarlChair.png' width={40} height={40} alt='empty chair' />
                                                      </div>
                                                      <p style={{paddingTop: '10px'}}>{t('movies:eptChair')}</p>
                                                </Col>
                                                <Col span={6}>
                                                      <div style={{ textAlign: 'center' }}>
                                                            <Image src='/images/chair/seat-select-normal.png' width={40} height={40} alt='Booking chair' />
                                                      </div>
                                                      <p style={{paddingTop: '10px'}}>{t('movies:selectChair')}</p>
                                                </Col>
                                                <Col span={6}>
                                                      <div style={{ textAlign: 'center' }}>
                                                            <Image src='/images/chair/seat-process-normal.png' width={40} height={40} alt='Booking chair' />
                                                      </div>
                                                      <p style={{paddingTop: '10px'}}>{t('movies:KeepChair')}</p>
                                                </Col>
                                                <Col span={6}>
                                                      <div style={{ textAlign: 'center' }}>
                                                            <Image src='/images/chair/seat-buy-normal.png' width={40} height={40} alt='Booking chair' />
                                                      </div>
                                                      <p style={{paddingTop: '10px'}}>{t('movies:SoldChair')}</p>
                                                </Col>
                                          </Row>
                                          <div className={style.sreen}>
                                                <Image src='/images/Screen (2).png' width={700} height={40} alt='empty chair' />
                                          </div>
                                          {!isLoading || !isFetching ? (
                                                <div className={style.chairs}>
                                                      <div>
                                                            <LineChair isLoading={loading} dataChair={dataChair?.data?.A} refetch={refetch} isError={isError} handleBoxClick={handleBoxClick} selectedBoxes={selectedBoxes} ></LineChair>
                                                            <LineChair isLoading={loading} dataChair={dataChair?.data?.B} refetch={refetch} isError={isError} handleBoxClick={handleBoxClick} selectedBoxes={selectedBoxes} ></LineChair>
                                                            <LineChair isLoading={loading} dataChair={dataChair?.data?.C} refetch={refetch} isError={isError} handleBoxClick={handleBoxClick} selectedBoxes={selectedBoxes} ></LineChair>
                                                            <LineChair isLoading={loading} dataChair={dataChair?.data?.D} refetch={refetch} isError={isError} handleBoxClick={handleBoxClick} selectedBoxes={selectedBoxes} ></LineChair>
                                                            <LineChair isLoading={loading} dataChair={dataChair?.data?.E} refetch={refetch} isError={isError} handleBoxClick={handleBoxClick} selectedBoxes={selectedBoxes} ></LineChair>
                                                            <LineChair isLoading={loading} dataChair={dataChair?.data?.F} refetch={refetch} isError={isError} handleBoxClick={handleBoxClick} selectedBoxes={selectedBoxes} ></LineChair>
                                                            <LineChair isLoading={loading} dataChair={dataChair?.data?.G} refetch={refetch} isError={isError} handleBoxClick={handleBoxClick} selectedBoxes={selectedBoxes} ></LineChair>
                                                            <LineChair isLoading={loading} dataChair={dataChair?.data?.H} refetch={refetch} isError={isError} handleBoxClick={handleBoxClick} selectedBoxes={selectedBoxes} ></LineChair>
                                                            <LineChair isLoading={loading} dataChair={dataChair?.data?.I} refetch={refetch} isError={isError} handleBoxClick={handleBoxClick} selectedBoxes={selectedBoxes} ></LineChair>
                                                            <LineChair isLoading={loading} dataChair={dataChair?.data?.J} refetch={refetch} isError={isError} handleBoxClick={handleBoxClick} selectedBoxes={selectedBoxes} ></LineChair>
                                                      </div>
                                                </div>
                                          ) : (<div style={{width: '100%', textAlign: 'center'}}><Spin></Spin></div>)}
                                          <Row className={style.TypeChair}>
                                                <Col span={8}>
                                                      <div style={{ textAlign: 'center' }}>
                                                            <Image src='/images/NomarlChair.png' width={40} height={40} alt='empty chair' />
                                                      </div>
                                                      <p style={{paddingTop: '10px'}}>{t('movies:SigleChair')}</p>
                                                </Col>
                                                <Col span={8}>
                                                      <div style={{ textAlign: 'center' }}>
                                                            <Image src='/images/chair/ChairVip.png' width={50} height={50} alt='Booking chair' />
                                                      </div>
                                                      <p style={{paddingTop: '10px'}}>{t('movies:VipChair')}</p>
                                                </Col>
                                                <Col span={8}>
                                                      <div style={{ textAlign: 'center' }}>
                                                            <Image src='/images/chair/doubleChair.png' width={50} height={50} alt='Booking chair' />
                                                      </div>
                                                      <p style={{paddingTop: '10px'}}>{t('movies:DoubleChair')}</p>
                                                </Col>
                                          </Row>
                                    </Col>) : (<OrderTicket selectedBoxes={selectedBoxes}  totalPrice={totalPrice + movieDetail?.price } expiresAt={dataChair?.time}></OrderTicket>)
                              }
                              <Col xs={24} sm={24} md={24} lg={6} className={style.inforTicket}>
                                    <Row gutter={[{sm: 24,md: 24,lg: 0},0]}>
                                          <Col xs={24} sm={10} md={8} lg={24} style={{display: 'flex', justifyContent: 'center'}}>
                                                <Image src={movieDetail?.image} alt='banner' width={150} height={330} />
                                          </Col>
                                          <Col xs={24} sm={14} md={16} lg={24}>
                                                <Row style={{ paddingTop: '30px' }}>
                                                      <Col>
                                                            <span className={style.title}>{t('movies:name')} : </span>
                                                      </Col>
                                                      <Col>
                                                            <p className={style.content}>{movieDetail?.name}</p>
                                                      </Col>
                                                </Row>
                                                <Row style={{ paddingTop: '15px', justifyContent: 'space-between' }}>
                                                      <Col>
                                                            <span className={style.title}>{t('homes:Category')} : </span>
                                                      </Col>
                                                      <Col>
                                                            <p className={style.content}>{movieDetail?.category[0]?.name}</p>
                                                      </Col>
                                                </Row>
                                                <Row style={{ paddingTop: '15px', justifyContent: 'space-between' }}>
                                                      <Col>
                                                            <span className={style.title}>{t('movies:time')} : </span>
                                                      </Col>
                                                      <Col>
                                                            <p className={style.content}>{movieDetail?.time}</p>
                                                      </Col>
                                                </Row>
                                                <Row style={{ paddingTop: '15px', justifyContent: 'space-between' }}>
                                                      <Col>
                                                            <span className={style.title}>{t('movies:Room')} : </span>
                                                      </Col>
                                                      <Col>
                                                            <p className={style.content}>{values?.room}</p>
                                                      </Col>
                                                </Row>
                                                <Row style={{ paddingTop: '15px' }}>
                                                      <Col>
                                                            <span className={style.title}>{t('movies:Showtime')} : </span>
                                                      </Col>
                                                      <Col>
                                                            <p className={style.content}>
                                                                  {values?.time} - {t('movies:date')} {values?.date}
                                                            </p>
                                                      </Col>
                                                </Row>
                                                <Row style={{ paddingTop: '15px', justifyContent: 'space-between', paddingBottom: '30px' }}>
                                                      <Col>
                                                            <span className={style.title}>{t('movies:chair')} : </span>
                                                      </Col>
                                                      {
                                                            selectedBoxes.length > 0 ? (<Col>
                                                                  {selectedBoxes.map((item: any) => (<span className={style.content}> {item.name} </span>))}
                                                            </Col>) : (<div>{t('movies:requireChair')}</div>)
                                                      }
                                                </Row>
                                                {
                                                      component === 1 ? (<Row className={style.submitTicket} style={{ justifyContent: 'center' }} gutter={[10, 10]}>
                                                            <Col span={12}>
                                                                  {
                                                                        selectedBoxes.length > 0 &&  <Button onClick={(() => setComponent(2))}>{t('movies:continue')}</Button>
                                                                  }
                                                            </Col>
                                                      </Row>) : (<Row className={style.submitTicket} gutter={[10, 10]}>
                                                            <Col span={12}>
                                                                  <Button onClick={(() => setComponent(1))}>{t('movies:Back')}</Button>
                                                            </Col>
                                                            <Col span={12}>
                                                                  <Button href={globalState as string}>{t('movies:continue')}</Button>
                                                            </Col>
                                                      </Row>)
                                                }
                                          </Col>
                                    </Row>
                              </Col>
                        </Row>
                  </div>
            </div>
      );
}

export default BookingTicketScreen;
