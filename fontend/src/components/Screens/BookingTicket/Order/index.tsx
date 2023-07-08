import React, { useEffect, useMemo, useState } from 'react';
import style from './style.module.less';
import { Button, Col, Dropdown, Form, Input, Radio, Row } from 'antd';
import Image from 'next/image';
import { checkAuth, getLocalStored } from '@/libs/localStorage';
import { FaRegUserCircle } from 'react-icons/fa';
import CounTime from '@/components/Elements/Timer/Timer';
import { queryAllDiscount, queryAllProduct, queryDiscountDetail } from '@/queries/hooks/product';
import { useRouter } from 'next/router';
import { TbDiscountCheck } from "react-icons/tb";
import { TDiscount, TProduct } from '@/modules/product';
import { AiOutlineCopy } from 'react-icons/ai';
import { toast } from 'react-toastify';
import { TQueryCode } from '@/modules/movies';
import { EOrder, EOrderBy } from '@/configs/interface.config';
interface IOrderTicket {
      expiresAt: any;
      totalPrice: number
}
function OrderTicket({ expiresAt, totalPrice }: IOrderTicket) {
      const { data: product } = queryAllProduct()
      const [params, setParams] = useState<TQueryCode>({
            page: 1,
            limit: 8,
            order: EOrder.DESC,
            orderBy: EOrderBy.CREATED_DATE,
      });
      const [percent, setPercent] = useState(0)
      const [enabled, setEnabled] = useState(false)
      // const values = getLocalStored('values');
      const movieDetail = getLocalStored('data');
      const [sweetCombo, setSweetCombo] = useState(product)
      const [token, setToken] = useState<string>('');
      const router = useRouter()
      useEffect(() => {
            const accessTokenCurrent = checkAuth();
            setToken(accessTokenCurrent);
            window.addEventListener('storage', () => {
                  const accessToken = checkAuth();
                  setToken(accessToken);
            });
      }, []);
      useEffect(() => {
            if (expiresAt <= 0) { router.push('/') }
      }, [expiresAt])
      const { data: discount } = queryAllDiscount(token)
      const priceProduct = useMemo(() => sweetCombo?.length > 0 ? sweetCombo?.reduce((amount: any, current: any) => amount + current?.amount * current?.price, 0) : null, [sweetCombo])
      const user = getLocalStored('USER_PROFILE')
      // const items: any = [
      //       {
      //             key: '1',
      //             label: (
      //                   discount && discount?.map((item: TDiscount) => (
      //                         <Row style={{ justifyContent: 'space-between' }}>
      //                               <Col><p>{item?.code}</p></Col>
      //                               <Col>
      //                                     <CopyToClipboard text={item.code} onCopy={() => toast.success('Copied')}>
      //                                           <AiOutlineCopy />
      //                                     </CopyToClipboard>
      //                               </Col>
      //                         </Row>
      //                   ))
      //             ),
      //       },
      // ];
      useEffect(() => {
            setSweetCombo(product)
      }, [product])
      const handleIncreateSweetCombo = (id: any) => {
            setSweetCombo((prev) => prev?.map((item: TProduct) => item.id === id ? { ...item, amount: item?.amount + 1 } : item))
      }
      const handleDeincreateSweetCombo = (id: any) => {
            setSweetCombo((prev) => prev?.map((item: TProduct) => item.id === id && item.amount > 0 ? { ...item, amount: item?.amount - 1 } : item))
      }
      // const { data: DetailDiscount } = queryDiscountDetail(token, params, enabled)
      // const onFinish = (values: any) => {
      //       setParams({ ...params, code: values?.code })
      //       setEnabled(true)
      // };
      const numberWithComas = (num: number) => num?.toString()?.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
      const handleUsingDiscount = (item: TDiscount) => {
            const moneyDiscount = ((item?.percent) / 100) * totalPrice;
            setPercent(moneyDiscount)
      }
      useEffect(() => {
            setPercent(0)
      }, [totalPrice])
      console.log(discount);
      return (
            <Col xs={24} sm={24} md={24} lg={18} className={style.order}>
                  <div className={style.warning}>
                        <p>Theo quy định của cục điện ảnh, phim này không dành cho khán giả dưới {movieDetail?.year_old} tuổi.</p>
                  </div>
                  <div className={style.time}>
                        <p>Thời gian giữ ghế</p>
                        <CounTime expiresAt={expiresAt} />
                  </div>
                  <Row className={style.InforUser}>
                        <Col span={24} className={style.title}>
                              <Row>
                                    <span><FaRegUserCircle /></span>
                                    <p>THÔNG TIN THANH TOÁN</p>
                              </Row>
                        </Col>
                        <Col span={24}>
                              <Row className={style.inforUser}>
                                    <Col xs={24} sm={8} className={style.inforDetail}>
                                          <h5>Họ Tên :</h5>
                                          <p>{user?.name}</p>
                                    </Col>
                                    <Col xs={24} sm={8} className={style.inforDetail}>
                                          <h5>Số điện thoại :</h5>
                                          <p>{user?.phone}</p>
                                    </Col>
                                    <Col xs={24} sm={8} className={style.inforDetail}>
                                          <h5>Email :</h5>
                                          <p>{user?.email}</p>
                                    </Col>
                              </Row>
                        </Col>
                        <Col span={24}>
                              <Row className={style.combo}>
                                    <Image src='/images/ic-combo.png' width={50} height={50} alt='combo' />
                                    <p>COMBO ƯU ĐÃI</p>
                              </Row>
                        </Col>
                        <Col span={24} className={style.tableCombo}>
                              <Row>
                                    <Col xs={2} sm={4} md={4}></Col>
                                    <Col xs={0} sm={0} md={8} className={style.nameCombo}>
                                          <p>Tên Combo</p>
                                    </Col>
                                    <Col xs={16} sm={16} md={8} className={style.desc}>
                                          <p>Mô tả</p>
                                    </Col>
                                    <Col xs={6} sm={4} md={4} className={style.mount}>
                                          <p>Số lượng</p>
                                    </Col>
                              </Row>
                        </Col>
                        {
                              sweetCombo?.map((item: TProduct) => (
                                    <Col span={24}>
                                          <Row className={style.comboSweet}>
                                                <Col xs={6} sm={5} md={5}>
                                                      <Image src={item?.image} width={100} height={100} alt='combo' />
                                                </Col>
                                                <Col xs={0} sm={0} md={6} className={style.nameInforCombo}>
                                                      <p>{item?.name}</p>
                                                </Col>
                                                <Col xs={13} sm={16} md={10}>
                                                      <p>TIẾT KIỆM 46K!!! Gồm: 1 Bắp (69oz) + 2 Nước có gaz (22oz)</p>
                                                </Col>
                                                <Col xs={5} sm={3} md={3} className={style.countComboSweet}>
                                                      <span>{item.amount}</span>
                                                      <Row>
                                                            <span style={{ marginRight: '10px' }} className={style.increate} onClick={() => handleIncreateSweetCombo(item?.id)}>+</span>
                                                            <span className={style.descrease} onClick={() => handleDeincreateSweetCombo(item?.id)}>-</span>
                                                      </Row>
                                                </Col>
                                          </Row>
                                    </Col>
                              ))
                        }
                        <Col span={24}>
                              <Row>
                                    <Col span={12} className={style.combo}>
                                          <Image src='/images/ic-payment.png' width={56} height={35} alt='combo' />
                                          <p>GIẢM GIÁ</p>
                                    </Col>
                                    {/* <Col span={12} className={style.getVoucher}>
                                          <Dropdown menu={{ items }} placement="top" arrow={{ pointAtCenter: true }}>
                                                <p>Lấy mã voucher của bạn</p>
                                          </Dropdown>
                                    </Col> */}
                              </Row>
                        </Col>
                        {/* <Col span={24}>
                              <Form
                                    name="basic"
                                    initialValues={{ remember: true }}
                                    onFinish={onFinish}
                                    onFinishFailed={onFinishFailed}
                                    autoComplete="off"
                                    style={{ display: 'flex', justifyContent: 'space-between' }}
                              >
                                    <Form.Item
                                          name="code"
                                    >
                                          <Input placeholder='Vui lòng nhập mã ...' className={style.inputVoucher} />
                                    </Form.Item>

                                    <Form.Item>
                                          <Button className={style.buttonSubmit} htmlType="submit">
                                                TÌM DISCOUNT
                                          </Button>
                                    </Form.Item>
                              </Form>
                        </Col> */}
                        {/* {
                              DetailDiscount && DetailDiscount ? (<Col span={24}>
                                    <Row>
                                          <Col span={24} className={style.headerDiscount}>
                                                <Row style={{ textAlign: 'center' }}>
                                                      <Col span={6}>
                                                            <p>Mã voucher</p>
                                                      </Col>
                                                      <Col span={8}>
                                                            <p>Nội dung voucher</p>
                                                      </Col>
                                                      <Col span={6}>
                                                            <p>Ngày hết hạn</p>
                                                      </Col>
                                                      <Col span={4}></Col>
                                                </Row>
                                          </Col>
                                          <Col span={24}>
                                                <Row className={style.contentDiscount} gutter={[24, 0]}>
                                                      <Col span={6} className={style.code}>
                                                            <p>{DetailDiscount?.code}</p>
                                                      </Col>
                                                      <Col span={8}>
                                                            <p>Giảm ${DetailDiscount?.percent} % trên tổng hoá đơn</p>
                                                      </Col>
                                                      <Col span={6}>
                                                            <p>{DetailDiscount?.end_time}</p>
                                                      </Col>
                                                      <Col span={4}>
                                                            <Button className={style.buttonSubmit} onClick={()=>handleUsingDiscount(DetailDiscount)}>ÁP DỤNG</Button>
                                                      </Col>
                                                </Row>
                                          </Col>
                                    </Row>
                              </Col>) : ''
                        } */}
                        <Col span={24}>
                              <Row>
                                    <Col span={24} className={style.headerDiscount}>
                                          <Row style={{ textAlign: 'center' }}>
                                                <Col xs={9} sm={6}>
                                                      <p>Mã voucher</p>
                                                </Col>
                                                <Col xs={15} sm={8}>
                                                      <p>Nội dung voucher</p>
                                                </Col>
                                                <Col xs={0} sm={6} className={style.expiredTime}>
                                                      <p>Ngày hết hạn</p>
                                                </Col>
                                                <Col xs={0} sm={4}></Col>
                                          </Row>
                                    </Col>
                                    <Col span={24}>
                                          {
                                                discount && discount.map((item: TDiscount) => (
                                                      <Row className={style.contentDiscount} gutter={[24, 0]}>
                                                            <Col xs={6} sm={6} className={style.code}>
                                                                  <p>{item?.code}</p>
                                                            </Col>
                                                            <Col xs={13} sm={8}>
                                                                  <p>Giảm ${item?.percent} % trên tổng hoá đơn</p>
                                                            </Col>
                                                            <Col xs={0} sm={6} className={style.expiredTimeContent}>
                                                                  <p>{item?.end_time}</p>
                                                            </Col>
                                                            <Col xs={5} sm={4}>
                                                                  <Button className={style.buttonSubmit1} onClick={() => handleUsingDiscount(item)}><TbDiscountCheck /></Button>
                                                                  <Button className={style.buttonSubmit} onClick={() => handleUsingDiscount(item)}>ÁP DỤNG</Button>
                                                            </Col>
                                                      </Row>
                                                ))
                                          }
                                    </Col>
                              </Row>
                        </Col>
                        <Col span={24}>
                              <Row className={style.totalMoney}>
                                    <Col span={24} className={style.money}>
                                          <p>Tổng tiền:</p>
                                          <span>{numberWithComas(totalPrice + priceProduct)} vnđ</span>
                                    </Col>
                                    <Col span={24} className={style.money}>
                                          <p>Số tiền được giảm:</p>
                                          <span>{numberWithComas(percent)} vnđ</span>
                                    </Col>
                                    <Col span={24} className={style.money}>
                                          <p>Số tiền cần thanh toán:</p>
                                          <span>{numberWithComas(totalPrice + priceProduct - percent)} vnđ</span>
                                    </Col>
                              </Row>
                        </Col>
                        <Col span={24}>
                              <Row className={style.combo}>
                                    <Image src='/images/ic-payment.png' width={56} height={35} alt='combo' />
                                    <p>PHƯƠNG THỨC THANH TOÁN</p>
                              </Row>
                        </Col>
                        <Col span={24}>
                              <Row className={style.payMent}>
                                    <Col span={24}>
                                          <p>Chọn thẻ thanh toán</p>
                                    </Col>
                                    <Col span={24}>
                                          <Form
                                                layout="horizontal"
                                          >
                                                <Form.Item>
                                                      <Radio.Group className={style.allMethod}>
                                                            <Row gutter={[24, 24]}>
                                                                  <Col xs={24} sm={8}>
                                                                        <Radio className={style.method} value="apple"> <Image src='/images/ic-payment.png' width={56} height={35} alt='combo' /> <span>Banking</span></Radio>
                                                                  </Col>
                                                                  <Col xs={24} sm={8}>
                                                                        <Radio className={style.method} value="apple1"> <Image src='/images/ic-payment.png' width={56} height={35} alt='combo' /> <span>ShoppePay</span></Radio>
                                                                  </Col>
                                                                  <Col xs={24} sm={8}>
                                                                        <Radio className={style.method} value="apple2"> <Image src='/images/ic-payment.png' width={56} height={35} alt='combo' /> <span>MomoPay</span></Radio>
                                                                  </Col>
                                                            </Row>
                                                      </Radio.Group>
                                                </Form.Item>
                                          </Form>
                                    </Col>
                              </Row>
                        </Col>
                  </Row>
            </Col>
      );
}

export default OrderTicket;