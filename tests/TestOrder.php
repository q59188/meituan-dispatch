<?php
namespace Cblink\MeituanDispatch\Tests;

use PHPUnit\Framework\TestCase;
use Cblink\MeituanDispatch\Dispatch;

class TestOrder extends TestCase
{
    protected $secret = '';

    protected $appKey = '';

    /**
     * 创建订单
     *
     * @return mixed
     */
    public function testCreateOrShop()
    {
        $goods[] = [
            'goodCount' => 2,
            'goodName' => '测试商品',
        ];

        $data = [
            'delivery_id' => 1,
            'order_id' => 1,
            'poi_seq' => '40001', // 美团的流水号加4为前缀
            'shop_id' => 'test_0001',
            'delivery_service_code' => 4011,
            'receiver_name' => 'test',
            'receiver_address' => '中国',
            'receiver_phone' => '',
            'receiver_lng' => (int) (113.957613 * pow(10, 6)),
            'receiver_lat' => (int) (22.538135 * pow(10, 6)),
            'goods_value' => 100,
            'goods_weight' => 1,
            'goods_detail' => json_encode(['goods' => $goods]),
        ];

        $result = (new Dispatch(['app_key' => $this->appKey, 'secret' => $this->secret, 'debug' => false]))->createByShop($data);

        $this->assertArrayHasKey('data', $result);
    }

    /**
     * 查询订单状态
     *
     * @return mixed
     */
    public function testQueryStatus()
    {
        $result = (new Dispatch([
            'app_key' => $this->appKey,
            'secret' => $this->secret,
            'debug' => false
        ]))->queryStatus([
            'mt_peisong_id' => '',
            'delivery_id' => ''
        ]);

        $this->assertArrayHasKey('data', $result);
    }
}