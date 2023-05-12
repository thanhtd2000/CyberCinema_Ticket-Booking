import React from 'react'
import style from './style.module.less'
import { Row, Col, Typography, Button } from 'antd'
import Link from 'next/link'
import Image from 'next/image'
const {Title, Paragraph} = Typography
function NewScreen() {
  return (
    <div className='News' style={{background: '#F1F1F1'}}>
      <div className='container'>
            <Row className={style.New}>
                  <Col span={24}>
                        <Title level={2}>KHUYẾN MÃI MỚI</Title>
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
                                                <Row gutter={[24, 0]} style={{alignItems: 'center'}}>
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
                                    <Row gutter={[24 , 24]}>
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
                                                <Row gutter={[24, 0]} style={{alignItems: 'center'}}>
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
                                    <Row gutter={[24 , 24]}>
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