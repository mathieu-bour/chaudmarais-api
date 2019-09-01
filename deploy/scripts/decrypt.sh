#!/bin/bash
KEYCHAIN_DIR=storage/keychain

echo "Keychain directory: ${KEYCHAIN_DIR}"

for f in $(ls ${KEYCHAIN_DIR}/*.enc); do
  PLAINTEXT_FILE=${KEYCHAIN_DIR}/$(basename ${KEYCHAIN_DIR}/${f} .enc)
  CIPHERTEXT_FILE=${PLAINTEXT_FILE}.enc

  gcloud kms encrypt \
    --location global \
    --keyring chaudmarais-keyring \
    --key chaudmarais-deploy-key \
    --plaintext-file ${PLAINTEXT_FILE} \
    --ciphertext-file ${CIPHERTEXT_FILE}

   echo "Decrypted: ${CIPHERTEXT_FILE} => ${PLAINTEXT_FILE}"
done;
