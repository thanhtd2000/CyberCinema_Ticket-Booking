import React, { useEffect, useMemo, useState } from 'react';
import style from './style.module.less';
import { Breadcrumb, Col, Form, Radio, Row, Spin, Tag } from 'antd';
import Image from 'next/image';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import ReactPlayer from 'react-player';
import { TMovies, TQueryMovies } from '@/modules/movies';
import dayjs from 'dayjs';
import { BsFillCalendarDateFill } from 'react-icons/bs';
import { FcOvertime } from 'react-icons/fc';
import { queryAllHours, queryAllRoom } from '@/queries/hooks/schedule';
import { getLocalStored, setLocalStored } from '@/libs/localStorage';
import { USER_PROFILE } from '@/queries/keys';
import { useRouter } from 'next/router'
import Link from 'next/link';
interface moviesDetaiil {
  moviesDetail: TMovies[];
}
function checkObjectValuesByKeys(obj: any, keys: string[]) {
  let check = false;
  if (!obj) return false;
  keys.forEach((key) => {
    if (obj?.hasOwnProperty(key)) {
      if (obj[key]) {
        check = true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  });
  return check;
}
function checkAllKeysHaveData(obj: any) {
  let count = 0;

  for (let key in obj) {
    count++;
  }

  if (count >= 3) {
    for (let key in obj) {
      if (!obj[key]) {
        return false;
      }
    }
    return true;
  }

  return false;
}
function MovieDetailScreen({ moviesDetail }: moviesDetaiil) {
  const [activeItemDate, setActiveItemDate] = useState(null);
  const [activeItemTime, setActiveItemTime] = useState(null);
  const [activeItemRoom, setActiveItemRoom] = useState(null);
  const [valueRoom, setValueRoom] = useState(Object);
  const user = getLocalStored(USER_PROFILE);
  const router = useRouter();
  const [params, setParams] = useState<TQueryMovies>({});
  const enableHour = checkObjectValuesByKeys(params, ['slug', 'date']);
  const enableRoom = checkObjectValuesByKeys(params, ['time']);
  const videoLink = useMemo(() => moviesDetail[0].trailer, [moviesDetail]);
  const videoTitle = useMemo(() => moviesDetail[0].name, [moviesDetail]);
  const data = moviesDetail[0]
  const handleItemClickDate = (itemId: any) => {
    setActiveItemDate(itemId);
    setActiveItemTime(null)
    setActiveItemRoom(null)
    setValueRoom(null)
    setParams((prev)=>({...prev,time: null}))
  };
  const handleItemClickTime = (itemId: any) => {
    setActiveItemTime(itemId);
  };
  const handleItemClickRoom = (itemId: any) => {
    setActiveItemRoom(itemId);
  };
  const onFinish = (values: any) => {
    if (checkAllKeysHaveData(values) && user) {
      setLocalStored("values",values)
      setLocalStored("data",data)
      setLocalStored("valueRoom",valueRoom)
      router.push('/booking');
    } else if (checkAllKeysHaveData(values) && !user) {
      router.push('/login');
    } else {
      return false;
    }
  };
  const handleChoseHours = (slug: string, date: string) => {
    setParams((prev) => ({ ...prev, slug, date }));
  };
  const handleChoseTime = (time: Date | undefined) => {
    setParams((prev) => ({ ...prev, time }));
  };
  const [hasWindow, setHasWindow] = useState(false);
  useEffect(() => {
    if (typeof window !== "undefined") {
      setHasWindow(true);
    }
  }, []);
  const { data: choseHours,isLoading } = queryAllHours(params, enableHour);
  const { data: choseRoom,isLoading:loading } = queryAllRoom(params, enableRoom);
  return (
    <div className={`${style.movies} moviesDetail`} style={{ background: '#0D0E10' }}>
      <div className='container'>
        <div>
          <Breadcrumb
            style={{ color: 'rgb(183, 177, 177)', paddingBottom: '30px', fontSize: '17px' }}
            items={[
              {
                title: <Link style={{ color: '#999' }} href='/'>Home</Link>,
              },
              {
                  title: <Link style={{ color: '#999' }} href='/movies'>Movies</Link>,
                },
              {
                title: <span style={{ color: 'white' }}>{moviesDetail[0].name}</span>,
              },
            ]}
          />
        </div>
        <div>
          <Row gutter={[{ sm: 0, md: 30, lg: 50 }, 0]}>
            <Col xs={24} md={8} className={style.movieLeft}>
              <Image src={moviesDetail[0].image} width={500} height={620} alt='banner' />
            </Col>
            <Col xs={24} md={16} className={style.movieRight}>
              <Row>
                <Col span={24}>
                  <h1>{moviesDetail[0].name}</h1>
                </Col>
                <Col span={24} style={{ paddingTop: '12px', paddingBottom: '24px', color: 'rgb(171, 171, 171)' }}>
                  <Row>
                    <Col style={{ paddingRight: '15px' }}>{dayjs(moviesDetail[0].date).format('YYYY')}</Col>
                    <Col className={style.time}>{moviesDetail[0].time}</Col>
                    <Col style={{ paddingLeft: '15px' }}>16+</Col>
                  </Row>
                </Col>
                <Col className={style.overview}>
                  <h3>OVERVIEW</h3>
                  <ul className={style.overDetail}>
                    <li>
                      <p>{moviesDetail[0].description}</p>
                    </li>
                    <li>
                      <span>Time Premiere : </span>
                      <p>{dayjs(moviesDetail[0].date).format('DD/MM/YYYY')}</p>
                    </li>
                    <li>
                      <span>Directors : </span>
                      <p>{moviesDetail[0]?.director[0]?.name}</p>
                    </li>
                    <li>
                      <span>Categories : </span>
                      <p>
                        {moviesDetail[0]?.category.map((item) => (
                          <Tag className={style.tag}>{item.name}</Tag>
                        ))}
                      </p>
                    </li>
                  </ul>
                </Col>
                <Col span={24}>
                  <Row style={{ justifyContent: 'space-between', alignItems: 'center' }}>
                    <h3 style={{ color: 'rgb(236, 229, 229)', fontSize: '25px', padding: '10px 0', fontWeight: '500' }}>
                      Actors
                    </h3>
                  </Row>
                </Col>
                <Col className={style.actor}>
                  {moviesDetail[0]?.actor.map((item) => (
                    <div className={style.actorItem}>
                      {item?.image === null ? (
                        <Image src='/images/avatarDefault.jpg' width={80} height={80} alt='actor' />
                      ) : (
                        <Image src={item?.image} width={80} height={80} alt='actor' />
                      )}
                      <p>{item?.name}</p>
                    </div>
                  ))}
                </Col>
              </Row>
            </Col>
          </Row>
        </div>
        {dayjs(moviesDetail[0]?.date).isAfter(dayjs()) === true ? (
          ''
        ) : (
          <Form onFinish={onFinish}>
            <div>
              <Row className={style.date}>
                <Col span={24}>
                  <h3>Chọn Ngày</h3>
                </Col>
                <Col xs={24} sm={18} md={16} lg={14} style={{ overflow: 'hidden' }}>
                  <Row className={style.listDate}>
                    <Col>
                      <Form.Item name='date' rules={[{ required: true, message: 'Vui lòng chọn ngày' }]}>
                        <Radio.Group style={{display: 'flex'}}>
                          {data?.schedules ? (
                            data?.schedules.map((item: any, index) => (
                              <Radio
                                value={dayjs(item).format('YYYY-MM-DD')}
                                onChange={() => handleItemClickDate(index)}
                                onClick={() =>
                                  handleChoseHours(data?.slug, dayjs(item).format('YYYY-MM-DD'))
                                }
                                className={activeItemDate === index ? style.active : style.dateItem}
                              >
                                <div>
                                  <p className={style.selectMonth}>{dayjs(item).format('dddd')}</p>
                                  <p className={style.selectDate}>{dayjs(item).format('DD')}</p>
                                  <p className={style.selectMonth}>{dayjs(item).format('MMMM')}</p>
                                </div>
                              </Radio>
                            ))
                          ) : (
                            <p>Update late...</p>
                          )}
                        </Radio.Group>
                      </Form.Item>
                    </Col>
                  </Row>
                </Col>
              </Row>
            </div>
            <div>
              <Row className={style.calendar}>
                <Col span={24}>
                  <h3>Chọn Lịch Chiếu</h3>
                </Col>
                <Col span={24}>
                  <Row>
                    <Col span={24}>
                      <Row gutter={[25, 15]}>
                        <Col>
                          <Form.Item name='time'>
                              {!isLoading ? (<Radio.Group>
                              {choseHours ? (
                                choseHours.map((item: any, index:number) => (
                                  <Radio
                                    value={item.time}
                                    onClick={() => handleChoseTime(item.time)}
                                    onChange={() => handleItemClickTime(index)}
                                  >
                                    <div className={activeItemTime === index ? style.active : style.calendarItem}>
                                      <span>{item.time}</span>
                                    </div>
                                  </Radio>
                                ))
                              ) : (
                                <Row style={{ justifyContent: 'center', width: '100%', padding: '20px 0' }}>
                                  <div style={{ textAlign: 'center' }}>
                                    <BsFillCalendarDateFill
                                      style={{ width: '100px', height: '100px', color: 'white' }}
                                    />
                                    <p style={{ color: 'white', paddingTop: '20px', fontSize: '14px' }}>
                                      Vui lòng chọn ngày
                                    </p>
                                  </div>
                                </Row>
                              )}
                            </Radio.Group>) : (<Spin/>)}
                          </Form.Item>
                        </Col>
                      </Row>
                    </Col>
                  </Row>
                </Col>
              </Row>
            </div>
            <div>
              <Row className={style.calendar}>
                <Col span={24}>
                  <h3>Chọn Phòng</h3>
                </Col>
                <Col span={24}>
                  <Row>
                    <Col span={24}>
                      <Row gutter={[25, 15]}>
                        <Col>
                          <Form.Item name='room'>
                              {!loading ? (<Radio.Group>
                              {choseRoom && params?.time ? (
                                choseRoom.map((item: any,index:number) => (
                                  <Radio value={item.name} onChange={() => handleItemClickRoom(index)} onClick={() => setValueRoom(item)}>
                                    <div className={activeItemRoom === index ? style.active : style.calendarItem}>
                                       <span>{item.name}</span>
                                    </div>
                                  </Radio>
                                ))
                              ) : (
                                <Row style={{ justifyContent: 'center', width: '100%', padding: '20px 0' }}>
                                  <div style={{ textAlign: 'center' }}>
                                    <FcOvertime style={{ width: '100px', height: '100px', color: 'white' }} />
                                    <p style={{ color: 'white', paddingTop: '20px', fontSize: '14px' }}>
                                      Vui lòng chọn giờ chiếu
                                    </p>
                                  </div>
                                </Row>
                              )}
                            </Radio.Group>) : (<Spin/>)}
                          </Form.Item>
                        </Col>
                      </Row>
                    </Col>
                  </Row>
                </Col>
              </Row>
            </div>
            <Form.Item>
              <button className={style.chooseChair}>Chọn ghế</button>
            </Form.Item>
          </Form>
        )}
        <div>
          <Row className={style.trailerMovies}>
            <Col>
              <h3>Trailer Movies</h3>
            </Col>
            <Col span={24} style={{ color: '#fff' }}>
              {hasWindow  && videoLink ? (
                <ReactPlayer
                  title={videoTitle}
                  controls
                  width='100%'
                  height='550px'
                  loop
                  url={videoLink}
                  allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture'
                  allowFullScreen
                />
              ) : (
                <div style={{textAlign: 'center'}}>
                  <Spin/>
                </div>
              )}
            </Col>
          </Row>
        </div>
      </div>
    </div>
  );
}

export default MovieDetailScreen;
