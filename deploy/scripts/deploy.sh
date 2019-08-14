#!/bin/bash
while getopts ":b:s:" opt; do
  case ${opt} in
    b)
      BRANCH_NAME=${OPTARG}
      ;;
    s)
      SHORT_SHA=${OPTARG}
      ;;
    \?)
      echo "Invalid option: -$OPTARG"
      ;;
  esac
done

ENV_VARS=$(./deploy/scripts/envcat.sh ./storage/keychain/env.${BRANCH_NAME})

gcloud beta run deploy chaudmarais-api-${BRANCH_NAME} \
    --image eu.gcr.io/chaud-marais/chaudmarais-api:${SHORT_SHA} \
    --platform=managed \
    --region=europe-west1 \
    --allow-unauthenticated \
    --set-env-vars="${ENV_VARS},SHORT_SHA=${SHORT_SHA}"
