import 'dart:convert';

class Document {
  String id;
  String name;
  String category;
  String subCategory;
  DateTime createdAt;
  Document({
    required this.id,
    required this.name,
    required this.category,
    required this.subCategory,
    required this.createdAt,
  });

  Document copyWith({
    String? id,
    String? name,
    String? category,
    String? subCategory,
    DateTime? createdAt,
  }) {
    return Document(
      id: id ?? this.id,
      name: name ?? this.name,
      category: category ?? this.category,
      subCategory: subCategory ?? this.subCategory,
      createdAt: createdAt ?? this.createdAt,
    );
  }

  Map<String, dynamic> toMap() {
    return <String, dynamic>{
      '_id': id,
      'name': name,
      'category': category,
      'subCategory': subCategory,
      'createdAt': createdAt.toIso8601String(),
    };
  }

  factory Document.fromMap(Map<String, dynamic> map) {
    return Document(
      id: map['_id'] as String,
      name: map['name'] as String,
      category: map['category'] as String,
      subCategory: map['subCategory'] as String,
      createdAt: DateTime.tryParse(map['createdAt']) ?? DateTime.now(),
    );
  }

  String toJson() => json.encode(toMap());

  factory Document.fromJson(String source) =>
      Document.fromMap(json.decode(source) as Map<String, dynamic>);

  @override
  String toString() {
    return 'Document(id: $id, name: $name, category: $category, subCategory: $subCategory, createdAt: $createdAt)';
  }

  @override
  bool operator ==(Object other) {
    if (identical(this, other)) return true;

    return other is Document &&
        other.id == id &&
        other.name == name &&
        other.category == category &&
        other.subCategory == subCategory &&
        other.createdAt == createdAt;
  }

  @override
  int get hashCode {
    return id.hashCode ^
        name.hashCode ^
        category.hashCode ^
        subCategory.hashCode ^
        createdAt.hashCode;
  }
}
