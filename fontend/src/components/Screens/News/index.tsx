import React from 'react'
import style from './style.module.less'
import { Row, Col, Typography, Button, Breadcrumb } from 'antd'
import Link from 'next/link'
import Image from 'next/image'
import { TPost } from '@/modules/post'
const { Title } = Typography
interface INewScreen {
      listNews: TPost[];

}
function NewScreen({ listNews }: INewScreen) {
      const listNewsRight = listNews.slice(1, 3)
      const listNewsBottom = listNews.slice(1, 5)
      return (
            <div className='News' style={{ background: '#0D0E10' }}>
                  <div className='container'>
                        <Row className={style.New}>
                              <Col span={24}>
                                    <Breadcrumb
                                          style={{ color: 'rgb(183, 177, 177)', paddingBottom: '30px', fontSize: '17px' }}
                                          items={[
                                                {
                                                      title: <Link style={{ color: '#999' }} href='/'>Home</Link>,
                                                },
                                                {
                                                      title: <Link style={{ color: '#999' }} href='/movies'>News</Link>,
                                                }
                                          ]}
                                    />
                              </Col>
                              <Col span={24}>
                                    <Title level={2}>KHUYẾN MÃI MỚI</Title>
                              </Col>
                              <Col span={24}>
                                    <Row gutter={[0, 24]}>
                                          <Col span={24}>
                                                <Row gutter={[24, 24]}>
                                                      <Col xs={24} sm={24} md={24} lg={12} className={style.mainNews}>
                                                            <Link href={`news/${listNews[0]?.slug}`}>
                                                                  <Image src={listNews[0]?.image} width={546} height={415} alt='news'></Image>
                                                                  <Title level={3}>{listNews[0]?.name}</Title>
                                                            </Link>
                                                      </Col>
                                                      <Col xs={24} sm={24} md={24} lg={12}>
                                                            <Row gutter={[24, 24]} style={{ alignItems: 'center' }}>
                                                                  {
                                                                        listNewsRight && listNewsRight.map((item) => (
                                                                              <Col xs={24} sm={12} md={12} lg={12} xl={12}>
                                                                                    <Link href={`news/${item?.slug}`}>
                                                                                          <Image src={item?.image} width={312} height={208} alt='news'></Image>
                                                                                          <Title level={4}>{item?.name}</Title>
                                                                                    </Link>
                                                                              </Col>
                                                                        ))
                                                                  }
                                                            </Row>
                                                      </Col>

                                                </Row>
                                          </Col>
                                          <Col span={24}>
                                                <Row gutter={[24, 0]}>
                                                      {
                                                            listNewsBottom && listNewsBottom.map((item) => (
                                                                  <Col xs={24} sm={12} md={12} lg={6}>
                                                                        <Link href={`news/${item?.slug}`}>
                                                                              <Image src={item?.image} width={312} height={208} alt='news'></Image>
                                                                              <Title level={4}>{item?.name}</Title>
                                                                        </Link>
                                                                  </Col>
                                                            ))
                                                      }
                                                </Row>
                                          </Col>
                                    </Row>
                              </Col>
                              <Col span={24} className={style.watchMore}><Button>Xem thêm </Button></Col>
                        </Row>
                        <Row className={style.Offer}>
                              <Col span={24}>
                                    <Title level={2}>ƯU ĐÃI MỚI</Title>
                              </Col>
                              <Col span={24}>
                                    <Row gutter={[0, 24]}>
                                          <Col span={24}>
                                                <Row gutter={[24, 0]}>
                                                      <Col span={12}>
                                                            <Image src='/images/uudai.png' width={546} height={415} alt='news'></Image>
                                                            <Title level={3}>Cyber Movies với nhiều ưu đãi đặc biệt</Title>
                                                      </Col>
                                                      <Col span={12}>
                                                            <Row gutter={[24, 0]} style={{ alignItems: 'center' }}>
                                                                  <Col span={12}>
                                                                        <Image src='/images/uudai.png' width={312} height={208} alt='news'></Image>
                                                                        <Title level={4}>Cyber Movies với nhiều ưu đãi đặc biệt</Title>
                                                                  </Col>
                                                                  <Col span={12}>
                                                                        <Image src='/images/uudai.png' width={312} height={208} alt='news'></Image>
                                                                        <Title level={4}>Cyber Movies với nhiều ưu đãi đặc biệt</Title>
                                                                  </Col>
                                                            </Row>
                                                      </Col>

                                                </Row>
                                          </Col>
                                          <Col span={24}>
                                                <Row gutter={[24, 24]}>
                                                      <Col span={6}>
                                                            <Image src='/images/uudai2.jpg' width={312} height={208} alt='news'></Image>
                                                            <Title level={4}>Cyber Movies với nhiều ưu đãi đặc biệt</Title>
                                                      </Col>
                                                      <Col span={6}>
                                                            <Image src='/images/uudai2.jpg' width={312} height={208} alt='news'></Image>
                                                            <Title level={4}>Cyber Movies với nhiều ưu đãi đặc biệt</Title>
                                                      </Col>
                                                      <Col span={6}>
                                                            <Image src='/images/uudai2.jpg' width={312} height={208} alt='news'></Image>
                                                            <Title level={4}>Cyber Movies với nhiều ưu đãi đặc biệt</Title>
                                                      </Col>
                                                      <Col span={6}>
                                                            <Image src='/images/uudai2.jpg' width={312} height={208} alt='news'></Image>
                                                            <Title level={4}>Cyber Movies với nhiều ưu đãi đặc biệt</Title>
                                                      </Col>
                                                </Row>
                                          </Col>
                                    </Row>
                              </Col>
                              <Col span={24} className={style.watchMore}><Button>Xem thêm </Button></Col>
                        </Row>
                  </div>
            </div>
      )
}

export default NewScreen