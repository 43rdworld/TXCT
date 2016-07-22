USE [GSNETX_Web_Events]
GO

/****** Object:  StoredProcedure [dbo].[sp_Save_TCT_RallyPackageOrders]    Script Date: 7/10/2016 10:49:30 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[sp_Save_TCT_RallyPackageOrders]
	@formSecret				varchar(100),
	@ipAddress				varchar(64),
	@browser				varchar(250),
	@browserVersion			varchar(250),
	@os						varchar(250),
	@rallyDate				varchar(100),
	@rallyCount				varchar(25),
	@rallyCookies			varchar(50),
	@rallyPatches			varchar(50),
	@rallyPickup			varchar(50),
	@rallyFName				varchar(250),
	@rallyLName				varchar(250),
	@rallyEmail				varchar(500),
	@rallyPhone				varchar(50),
	@billingSame			bit,
	@billingFName			varchar(250),
	@billingLName			varchar(250),
	@billingAddress			varchar(500),
	@billingCity			varchar(250),
	@billingState			varchar(50),
	@billingZip				varchar(50),
	@billingEmail			varchar(500),
	@rallyOrderItemized		varchar(3000),
	@rallyOrderCookies		varchar(250),
	@rallyOrderPatches		varchar(250),
	@rallyOrderSubTotal		varchar(250),
	@rallyOrderTax			varchar(250),
	@rallyOrderGrandTotal	varchar(250),
	@orderInvoice			varchar(250),
	@authCode				varchar(250)
AS
INSERT INTO [tbl_TCT_RallyPackageOrders] 
	(
	 [formSecret]
	,[ipAddress]
	,[browser]
	,[browserVersion]
	,[os]
	,[rallyDate]
	,[rallyCount]
	,[rallyPatches]
	,[rallyCookies]
	,[rallyPickup]
	,[rallyFName]
	,[rallyLName]
	,[rallyEmail]
	,[rallyPhone]
	,[billingSame]
	,[billingFName]
	,[billingLName]
	,[billingAddress]
	,[billingCity]
	,[billingState]
	,[billingZip]
	,[billingEmail]
	,[rallyOrderItemized]
	,[rallyOrderCookies]
	,[rallyOrderPatches]
	,[rallyOrderSubTotal]
	,[rallyOrderTax]
	,[rallyOrderGrandTotal]
	,[orderInvoice]
	,[authCode]
	)
    VALUES
    (
	 @formSecret
	,@ipAddress
	,@browser
	,@browserVersion
	,@os
	,CAST(@rallyDate AS date)
	,CAST(@rallyCount AS INT)
	,CAST(@rallyCookies AS INT)
	,CAST(@rallyPatches AS INT)
	,@rallyPickup
	,@rallyFName
	,@rallyLName
	,@rallyEmail
	,@rallyPhone
	,@billingSame
	,@billingFName
	,@billingLName
	,@billingAddress
	,@billingCity
	,@billingState
	,@billingZip
	,@billingEmail
	,@rallyOrderItemized
	,CAST(@rallyOrderCookies AS MONEY)
	,CAST(@rallyOrderPatches AS MONEY)
	,CAST(@rallyOrderSubTotal AS MONEY)
	,CAST(@rallyOrderTax AS MONEY)
	,CAST(@rallyOrderGrandTotal AS MONEY)
	,@orderInvoice
	,@authCode
    );


GO


