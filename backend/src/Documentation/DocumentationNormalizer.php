<?php

namespace App\Documentation;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class DocumentationNormalizer.
 */
final class DocumentationNormalizer implements NormalizerInterface
{
    /**
     * @var NormalizerInterface
     */
    private $normalizerDeferred;

    /**
     * DocumentationNormalizer constructor.
     *
     * @param NormalizerInterface $normalizerDeferred
     */
    public function __construct(NormalizerInterface $normalizerDeferred)
    {
        $this->normalizerDeferred = $normalizerDeferred;
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $allowedFormat = ['application/json'];
        $tokenDocumentation = [
            'paths' => [
                '/api/users/token' => [
                    'post' => [
                        'tags' => ['User'],
                        'operationId' => 'postTokenItem',
                        'consumes' => ['application/json'],
                        'produces' => $allowedFormat,
                        'summary' => 'Get JWT token to login.',
                        'parameters' => [
                            ['in' => 'body', 'name' => 'UserLoginForm', 'schema' => ['$ref' => '#/definitions/UserLoginForm']],
                        ],
                        'responses' => [
                            200 => [
                                'description' => 'give JWT token',
                                'schema' => ['$ref' => '#/definitions/JWTToken'],
                            ],
                            401 => [
                                'description' => 'Bad credentials',
                            ],
                        ],
                    ],
                ],
                '/api/users/token/refresh' => [
                    'post' => [
                        'tags' => ['User'],
                        'operationId' => 'postTokenItem',
                        'consumes' => ['application/json'],
                        'produces' => $allowedFormat,
                        'summary' => 'Refresh JWT token.',
                        'parameters' => [
                            ['in' => 'body', 'name' => 'UserLoginForm', 'schema' => [ '$ref' => '#/definitions/JWTRefreshToken']],
                        ],
                        'responses' => [
                            200 => [
                                'description' => 'give JWT token',
                                'schema' => ['$ref' => '#/definitions/JWTToken'],
                            ],
                            401 => [
                                'description' => 'Bad credentials',
                            ],
                        ],
                    ],
                ],
            ],
            'definitions' => [
                'JWTToken' => [
                    'type' => 'object',
                    'properties' => [
                        'token' => ['type' => 'string', 'readOnly' => true],
                        'refresh_token' => ['type' => 'string', 'readOnly' => true],
                    ],
                ],
                'JWTRefreshToken' => [
                    'type' => 'object',
                    'properties' => [
                        'refresh_token' => ['type' => 'string'],
                    ],

                ],
                'UserLoginForm' => [
                    'type' => 'object',
                    'properties' => [
                        'username' => ['type' => 'string'],
                        'password' => ['type' => 'string'],
                    ],
                ],
            ],
        ];

        $officialDocumentation = $this->normalizerDeferred->normalize($object, $format, $context);

        return array_merge_recursive($officialDocumentation, $tokenDocumentation);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $this->normalizerDeferred->supportsNormalization($data, $format);
    }
}