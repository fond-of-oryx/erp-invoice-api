<?php

namespace FondOfOryx\Zed\ErpInvoiceApi\Dependency\QueryContainer;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Zed\Api\Persistence\ApiQueryContainerInterface;

class ErpInvoiceApiToApiQueryContainerBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Api\Persistence\ApiQueryContainerInterface
     */
    protected $apiQueryContainerInterface;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\Transfer\AbstractTransfer
     */
    protected $abstractTransferMock;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\Transfer\AbstractTransfer
     */
    protected $apiItemTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiCollectionTransfer
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceApi\Dependency\QueryContainer\ErpInvoiceApiToApiQueryContainerBridge
     */
    protected $erpInvoiceApiToApiQueryContainerBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->apiQueryContainerInterface = $this->getMockBuilder(ApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->abstractTransferMock = $this->getMockBuilder(AbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->id = 1;

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceApiToApiQueryContainerBridge = new ErpInvoiceApiToApiQueryContainerBridge(
            $this->apiQueryContainerInterface,
        );
    }

    /**
     * @return void
     */
    public function testCreateApiItem(): void
    {
        $this->apiQueryContainerInterface->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->abstractTransferMock, $this->id)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpInvoiceApiToApiQueryContainerBridge->createApiItem(
                $this->abstractTransferMock,
                $this->id,
            ),
        );
    }

    /**
     * @return void
     */
    public function testCreateApiCollection(): void
    {
        $this->apiQueryContainerInterface->expects(static::atLeastOnce())
            ->method('createApiCollection')
            ->with([])
            ->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->erpInvoiceApiToApiQueryContainerBridge->createApiCollection([]),
        );
    }
}
