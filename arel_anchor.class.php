<?php
/**
 * @copyright  Copyright 2012 metaio GmbH. All rights reserved.
 * @author     metaio GmbH
 **/

/**
 *
 * スクリーンアンカー変数
 *
 */
abstract class ArelAnchor
{
    /**
     * アンカー無し
     */
    const ANCHOR_NONE       =	0;
    /**
     * 左端に設定
     */
    const ANCHOR_LEFT       =	1;
    /**
     * 右端に設定
     */
    const ANCHOR_RIGHT      =	2;
    /**
     * 下端に設定
     */
    const ANCHOR_BOTTOM     =	4;
    /**
     * 上端に設定
     */
    const ANCHOR_TOP        =	8;
    /**
     * 左右中央に設定
     */
    const ANCHOR_CENTER_H   =	16;
    /**
     * 垂直中心に設定
     */
    const ANCHOR_CENTER_V   =	32;

    /**
     * 左上に設定
     */
    const ANCHOR_TL         =   9;
    /**
     * 上心に設定
     */
    const ANCHOR_TC         =   24;
    /**
     * 右上に設定
     */
    const ANCHOR_TR         =   10;
    /**
     * 中央左に設定
     */
    const ANCHOR_CL         =   33;
    /**
     * 中央に設定
     */
    const ANCHOR_CC         =   48;
    /**
     * 中央右に設定
     */
    const ANCHOR_CR         =   34;
    /**
     * 左下に設定
     */
    const ANCHOR_BL         =   5;
    /**
     * 下心に設定
     */
    const ANCHOR_BC         =   20;
    /**
     * 右下に設定
     */
    const ANCHOR_BR         =   6;


    /**
     * Flags used for the attribute flag of the element screenanchor
     * スクリーンアンカーのフラグ要素
     */

    /**
     * フラグ無し
     */
    const FLAG_NONE =						0;
    /**
     * 平面における回転を許可しない
     */
    const FLAG_IGNORE_ROTATION =			1;
    /**
     * 平面におけるアニメーションを許可しない
     */
    const FLAG_IGNORE_ANIMATIONS =			2;
    /**
     * 解像度によるスケールの判定を行わない
     */
    const FLAG_IGNORE_SCREEN_RESOLUTION =	4;
}
