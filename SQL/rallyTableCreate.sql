USE [GSNETX_Web_Events]
GO

/****** Object:  Table [dbo].[tbl_TCT_RallyPackageOrders]    Script Date: 7/10/2016 10:48:37 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[tbl_TCT_RallyPackageOrders](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[guid] [uniqueidentifier] NULL CONSTRAINT [DF_tbl_TCT_RallyPackageOrders_guid]  DEFAULT (newid()),
	[formSecret] [varchar](100) NULL,
	[date] [datetime] NULL CONSTRAINT [DF_tbl_TCT_RallyPackageOrders_date]  DEFAULT (getdate()),
	[ipAddress] [varchar](64) NULL,
	[browser] [varchar](250) NULL,
	[browserVersion] [varchar](250) NULL,
	[os] [varchar](250) NULL,
	[rallyDate] [date] NULL,
	[rallyCount] [bigint] NULL,
	[rallyCookies] [bigint] NULL,
	[rallyPatches] [bigint] NULL,
	[rallyPickup] [varchar](50) NULL,
	[rallyFName] [varchar](250) NULL,
	[rallyLName] [varchar](250) NULL,
	[rallyEmail] [varchar](500) NULL,
	[rallyPhone] [varchar](50) NULL,
	[billingSame] [bit] NULL,
	[billingFName] [varchar](250) NULL,
	[billingLName] [varchar](250) NULL,
	[billingAddress] [varchar](500) NULL,
	[billingCity] [varchar](250) NULL,
	[billingState] [varchar](50) NULL,
	[billingZip] [varchar](50) NULL,
	[billingEmail] [varchar](500) NULL,
	[rallyOrderItemized] [varchar](3000) NULL,
	[rallyOrderCookies] [money] NULL,
	[rallyOrderPatches] [money] NULL,
	[rallyOrderSubTotal] [money] NULL,
	[rallyOrderTax] [money] NULL,
	[rallyOrderGrandTotal] [money] NULL,
	[orderInvoice] [varchar](250) NULL,
	[authCode] [varchar](250) NULL,
	[emailSent] [bit] NULL,
	[emailTransport] [varchar](50) NULL,
	[emailSentDate] [datetime] NULL,
	[active] [bit] NULL CONSTRAINT [DF_tbl_TCT_RallyPackageOrder_active]  DEFAULT ((1)),
	[notes] [varchar](max) NULL,
 CONSTRAINT [PK_tbl_TCT_RallyPackageOrder] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


