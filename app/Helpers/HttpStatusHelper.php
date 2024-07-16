<?php

namespace App\Helpers;

use Illuminate\Support\MessageBag;

class HttpStatusHelper
{

    const OK = 200;
    const CREATED = 201;
    const NO_CONTENT = 204;
    const NOT_MODIFIED = 304;
    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;
    const CONFLICT = 409;
    const UNPROCESSABLE_ENTITY = 422;
    const INTERNAL_SERVER_ERROR = 500;

    public static function getOkResponse($message = null, $data = null)
    {
        return [
            'code' => self::OK,
            'code_message' => self::getDescription(self::OK),
            'message' => $message ?: self::getDescription(self::OK),
            'results' => $data ?: null
        ];
    }

    public static function getCreatedResponse($message = null)
    {
        return [
            'code' => self::CREATED,
            'code_message' => self::getDescription(self::CREATED),
            'message' => $message ?: self::getDescription(self::CREATED)
        ];
    }

    public static function getNoContentResponse($message = null)
    {
        return [
            'code' => self::NO_CONTENT,
            'code_message' => self::getDescription(self::NO_CONTENT),
            'message' => $message ?: self::getDescription(self::NO_CONTENT)
        ];
    }

    public static function getNotFoundResponse($message = null)
    {
        return [
            'code' => self::NOT_FOUND,
            'code_message' => self::getDescription(self::NOT_FOUND),
            'message' => $message ?: self::getDescription(self::NOT_FOUND)
        ];
    }

    public static function getNotModifiedResponse($message = null)
    {
        return [
            'code' => self::NOT_MODIFIED,
            'code_message' => self::getDescription(self::NOT_MODIFIED),
            'message' => $message ?: self::getDescription(self::NOT_MODIFIED)
        ];
    }

    public static function getUnauthorizedResponse($message = null)
    {
        return [
            'code' => self::UNAUTHORIZED,
            'code_message' => self::getDescription(self::UNAUTHORIZED),
            'message' => $message ?: self::getDescription(self::UNAUTHORIZED)
        ];
    }

    public static function getValidationErrorResponse(MessageBag $err, $message)
    {
        return [
            'code' => self::UNPROCESSABLE_ENTITY,
            'code_message' => self::getDescription(self::UNPROCESSABLE_ENTITY),
            'message' => $message,
            'errors' => $err
        ];
    }

    public static function getInternalServerErrorResponse($err, $message = null, $hide = true)
    {
        $errMessage = is_array($err) ? $err['message'] : $err->getMessage();

        return [
            'code' => self::INTERNAL_SERVER_ERROR,
            'code_message' => self::getDescription(self::INTERNAL_SERVER_ERROR),
            'message' => $message ?: ['status' => 'danger', 'message' => self::getDescription(self::INTERNAL_SERVER_ERROR, $errMessage)],
            'errors' => self::getDescription(self::INTERNAL_SERVER_ERROR)
        ];
    }

    public static function getDescription($httpCode, $desc = null)
    {
        return self::_getStatusCodeMessage($httpCode, $desc);
    }

    private static function _getStatusCodeMessage($httpCode, $desc = null)
    {
        $codes = [
            self::OK => 'OK',
            self::CREATED => 'Created',
            self::NO_CONTENT => 'No Content',
            self::NOT_MODIFIED => 'Not Modified',
            self::BAD_REQUEST => 'Bad Request',
            self::UNAUTHORIZED => 'Unauthorized',
            self::FORBIDDEN => 'Forbidden',
            self::NOT_FOUND => 'Not Found',
            self::CONFLICT => 'Conflict',
            self::UNPROCESSABLE_ENTITY => 'Unprocessable Entity',
            self::INTERNAL_SERVER_ERROR => 'Internal Server Error'
        ];

        return $desc ? $codes[$httpCode] . '(desc: ' . $desc . ')' : $codes[$httpCode];
    }

}