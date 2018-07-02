.PHONY: protos
	protoc --proto_path=./   --php_out=./   --grpc_out=./   --plugin=protoc-gen-grpc=/home/carl/workspace/src/grpc/bins/opt/grpc_php_plugin  
